<?php

namespace App\Services;

use Exception;
use Mike42\Escpos\Printer;
use Illuminate\Support\Facades\Http;
use App\Services\BufferPrintConnector;

class RongtaRP850Printer
{
    protected $printer;
    protected $connector;
    protected $printerName;

    public function __construct($printerName = null)
    {
        $this->printerName = $printerName ?? config('printing.printer_name');
        $this->initialize();
    }

    protected function initialize()
    {
        try {
            $this->connector = new BufferPrintConnector();
            $this->printer = new Printer($this->connector);

            // Initialize printer
            $this->printer->initialize();

            // Set default print quality
            $this->setDarkness(config('printing.default_darkness'));

            // Set default font and alignment
            $this->printer->setFont(Printer::FONT_A);
            $this->printer->setJustification(Printer::JUSTIFY_LEFT);
        } catch (Exception $e) {
            throw new Exception("Failed to initialize printer: " . $e->getMessage());
        }
    }

    public function printInvoice($order)
    {
        try {
            $this->setLineHeight(80); // Normal spacing
            $this->printHeader($order);
            $this->setLineHeight(70); // Normal spacing
            $this->printItems($order);
            $this->setLineHeight(80); // Normal spacing
            $this->printTotals($order);
            $this->setLineHeight(60); // Normal spacing
            $this->printFooter($order);

            $this->printer->cut();
            $this->printer->close();

            $rawData = $this->connector->getData();
            $base64 = base64_encode($rawData);

            $apiKey = 'QIK3aQHWvU8T35_JRmjU0ohynW5JRrnYAPzvpRoKgrc'; // replace this!
            $apiKey = 'CdeDVRax_yI_1VA7FPoGyAEl6Y5BmzFAGjy6akEIgqI'; // replace this!
            $apiKey = '7cVBAjjXi93JfoULEHJGjzoIKTGcjTGr9-KKdwDeTB0'; // replace this!
            // $printerId = 74315710; // Replace with your actual printer ID
            // $printerId = 75006470; // Replace with your actual printer ID
            $printerId = 75222117; // Replace with your actual printer ID

            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($apiKey . ':'),
                'Content-Type' => 'application/json',
            ])->post('https://api.printnode.com/printjobs', [
                'printerId' => $printerId,
                'title' => 'POS Receipt',
                'contentType' => 'raw_base64',
                'content' => $base64,
            ]);
            info($response);
            // R6AL3gpCS7gDC@t
            return true;
        } catch (Exception $e) {
            throw new Exception("Printing failed: " . $e->getMessage());
        }
    }

    protected function printHeader($order)
    {
        // Header
        $this->printer->setJustification(Printer::JUSTIFY_CENTER);
        $this->printer->setTextSize(2, 2);
        $this->printer->text(config('app.name') . "\n");
        $this->printer->setTextSize(1, 1);
        $this->printer->text(config('printing.address') . "\n");
        $this->printer->text("VAT Reg. No.: " . config('printing.vat') . "\n");
        $this->printer->feed();

        $this->printer->text($this->printCenteredTitle("RETAIL INVOICE"));

        // Invoice Info
        $this->printer->setJustification(Printer::JUSTIFY_LEFT);
        $this->printer->text($this->formatLine("Cashier: " . @$order->staff->name, "Terminal ID: SB01"));
        $this->printer->text($this->formatLine("Invoice No: " . $order->invoice, now()->format('d/m/Y, h:i A')));
        $this->printer->feed();
        $this->printer->text($this->printCenteredTitle("CART INFO"));
    }

    protected function printCenteredTitle($title, $lineLength = 48)
    {
        $title = strtoupper($title);
        $titleWithSpaces = ' ' . $title . ' ';
        $titleLength = strlen($titleWithSpaces);
        $dashCount = $lineLength - $titleLength;

        $leftDashes = floor($dashCount / 2);
        $rightDashes = $dashCount - $leftDashes;

        return str_repeat("-", $leftDashes) . $titleWithSpaces . str_repeat("-", $rightDashes) . "\n";
    }

    protected function printItems($order)
    {
        // Table Header
        $this->printer->text("SL  Item Description       U.Price  Qty   Total\n");
        $this->printer->text(str_repeat("-", 48) . "\n");

        $subTotal = 0;
        foreach ($order->list as $key => $item) {
            $this->printItemLine($key, $item);
            $subTotal += $item->amount;
        }
        $this->printer->text(sprintf("%35s %10s\n", "Sub Total :", number_format($subTotal, 2)));

        $this->printer->feed();
        if ($order->return) {
            $this->printer->text($this->printCenteredTitle("RETURN ITEMS"));
            foreach ($order->return->list as $key => $returnItem) {
                $this->printReturnItemLine($key, $returnItem);
            }
            $this->printer->text(sprintf("%35s %10s\n", "Sub Total :", number_format($order->return->amount, 2)));
        }
    }

    protected function printReturnItemLine($index, $item)
    {
        $qty = $item->qty;
        if($item->product->attribute->name == 'KG' && $item->qty < 1) {
            $qty = ($item->qty * 1000) . ' Gram';
        }
        $line = sprintf(
            "%-3d %-18s %7.2f %6s %10.2f\n",
            $index + 1,
            substr(@$item->product->name, 0, 18),
            number_format($item->price, 2),
            $qty,
            number_format($item->amount, 2)
        );
        $this->printer->text($line);
    }

    // protected function printItemLine($index, $item)
    // {
    //     $qty = $item->qty;
    //     if ($item->product->attribute->name == 'KG' && $item->qty < 1) {
    //         $qty = ($item->qty * 1000) . 'g'; // Shorten "Gram" to fit better
    //     }

    //     $line = sprintf(
    //         "%-3d %-18s %7.2f %6s %10.2f\n",
    //         $index + 1,
    //         substr(@$item->product->name, 0, 18),
    //         number_format($item->rate - $item->product_discount, 2),
    //         $qty,
    //         number_format($item->amount, 2)
    //     );

    //     $this->printer->text($line);
    // }

    protected function printItemLine($index, $item)
    {
        $qty = $item->qty;
        if ($item->product->attribute->name == 'KG' && $item->qty < 1) {
            $qty = ($item->qty * 1000) . 'g'; // Show grams if < 1 KG
        }

        // Format with thousand separators
        $rate   = number_format($item->rate - $item->product_discount, 2);
        $amount = number_format($item->amount, 2);

        // Detect printer width (default 48 for 80mm)
        $lineWidth = property_exists($this->printer, 'char_per_line')
            ? $this->printer->char_per_line
            : 48; // fallback

        // Define column widths based on printer size
        if ($lineWidth <= 32) {
            // 58mm printer
            $cols = [2, 10, 6, 6, 8]; // [index, name, rate, qty, amount]
        } else {
            // 80mm printer
            $cols = [3, 12, 10, 6, 12];
        }

        $line = sprintf(
            "%-{$cols[0]}d %-{$cols[1]}s %{$cols[2]}s %{$cols[3]}s %{$cols[4]}s\n",
            $index + 1,
            substr(@$item->product->name, 0, $cols[1]),
            $rate,
            $qty,
            $amount
        );

        $this->printer->text($line);
    }

    protected function printTotals($order)
    {
        $this->printer->text(str_repeat("-", 48) . "\n");

        $this->printer->text($this->formatLine("Sub Total : ", number_format($order->total_amount, 2)));
        $this->printer->text($this->formatLine("(-) Discount : ", number_format($order->discount, 2)));
        if ($order->return) {
            $this->printer->text($this->formatLine("(-) Return Amount : ", number_format($order->return->amount, 2)));
        }

        $this->printer->text(str_repeat("-", 48) . "\n");

        if ($order->return) {
            $this->printer->text($this->formatLine("Net Payable : ", number_format($order->total_amount - $order->discount - $order->return->amount, 2)));
        } else {
            $this->printer->text($this->formatLine("Net Payable : ", number_format($order->total_amount - $order->discount, 2)));
        }
        $this->printer->text($this->formatLine("Cash Paid : ", number_format($order->receive_amount, 2)));
        $this->printer->text($this->formatLine("Change Amount : ", number_format($order->change_amount, 2)));

        $this->printer->text(str_repeat("-", 48) . "\n");
    }

    protected function formatLine($label, $text, $lineLength = 48)
    {
        $spaces = $lineLength - strlen($label) - strlen($text);
        return $label . str_repeat(' ', max(0, $spaces)) . $text . "\n";
    }

    protected function printFooter()
    {
        // Footer
        $this->printer->setJustification(Printer::JUSTIFY_CENTER);
        $this->printer->text("Thank you for Shopping with Saheb Bazar!\n");

        // QR Code
        $this->printer->feed();
        $this->printer->qrCode(config('app.url'), Printer::QR_ECLEVEL_L, 5);
        $this->printer->feed();

        $this->printer->text("Purchase of defected item must be exchanged\n by 24 hours with invoice.\n");
        $this->printer->feed();
        $this->printer->text("For any queries, suggestions or complain please\n call: " . config('printing.phone') . " (8:00 AM - 11:00 PM)\n");

        $this->printer->feed();
        $this->printer->text("Powered by Techno Park Bangladesh\n");
    }

    public function setLineHeight($height = 30)
    {
        try {
            $this->printer->getPrintConnector()->write(Printer::ESC . "3" . chr($height));
        } catch (Exception $e) {
            throw new Exception("Failed to set line height: " . $e->getMessage());
        }
    }

    public function setDarkness($darkness = 14)
    {
        $darkness = max(0, min(15, $darkness));
        $this->printer->getPrintConnector()->write(Printer::ESC . chr(69) . chr($darkness));
    }
}
