<?php
// config/printing.php
return [
    'printer_name' => env('PRINTER_NAME', 'RONGTA 80mm Series Printer'),
    'address' => env('PRINTER_ADDRESS', '123 Main St, City'),
    'tm_no' => env('PRINTER_TM', 'TAX-123456789'),
    'vat' => env('PRINTER_VAT', '000000000000000'),
    'phone' => env('PRINTER_PHONE', '+1 555-1234'),
    'default_darkness' => env('PRINTER_DARKNESS', 14), // 0-15
];
