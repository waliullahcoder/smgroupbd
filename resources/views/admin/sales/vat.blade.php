<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $report_title }}</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('backend/css/print.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&family=Roboto+Condensed&display=swap"
        rel="stylesheet">
    <style>
        @font-face {
            font-family: solaimanlipinormal;
            src: url({{ asset('backend/fonts/solaimanlipi/solaimanlipi_20-04-07.eot') }}) format("embedded-opentype"),
                url({{ asset('backend/fonts/solaimanlipi/solaimanlipi_20-04-07.woff') }}) format("woff"),
                url({{ asset('backend/fonts/solaimanlipi/solaimanlipi_20-04-07.ttf') }}) format("truetype");
        }

        body {
            font-family: 'solaimanlipinormal', sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
    </style>
</head>

<body>
    <div class="chalan_wrapper">
        <header class="chalan-header">
            <div class="header-top">
                <div>
                    <h1>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h1>
                    <h2 class="mb-1">জাতীয় রাজস্ব বোর্ড</h2>
                    <h2>কর চালানপত্র</h2>
                    <h3>[বিধি ৪০ এর উপ-বিধি (১) এর দফা (গ) ও দফা (চ) দ্রষ্টব্য]</h3>
                </div>
                <div class="musok">মূসক-৬.৩</div>
            </div>
            <div class="header-middle">
                <div class="label-wrapper">
                    <label class="header-label">নিবন্ধিত ব্যক্তির নামঃ</label>
                    <span class="label-val">Bonton Foods Ltd.</span>
                </div>
                <div class="label-wrapper">
                    <label class="header-label">নিবন্ধিত ব্যক্তির বিআইএনঃ</label>
                    <span class="label-val">001223862-0202</span>
                </div>
                <div class="label-wrapper">
                    <label class="header-label">চালানপত্র ইস্যুর ঠিকানাঃ</label>
                    <span class="label-val">Dag No: 859/1625/10203 Nandipara (Near Trimohoni Bridge) Banasree-Staff
                        Quarter Road, Khilgaon, Dhaka-1214</span>
                </div>
            </div>
            <div class="header-bottom">
                <table class="table table-borderless">
                    <tr>
                        <td><b>ক্রেতার নামঃ</b> {{ @$data->client->name }}</td>
                        <td width="220"><b>চালানপত্র নম্বরঃ</b> {{ @$data->invoice }}</td>
                    </tr>
                    <tr>
                        <td><b>ক্রেতার বিআইএনঃ</b> {{ @$data->client->bin_no }}</td>
                        <td width="220"><b>ইস্যুর তারিখঃ</b>{{ date('d-m-Y', strtotime($data->date)) }}</td>
                    </tr>
                    <tr>
                        <td>
                            <b>ক্রেতার ঠিকানাঃ</b>
                            <span style="width: 320px; display: inline-block;">{{ @$data->client->address }}</span>
                        </td>
                        <td width="220"><b>ইস্যুর সময়ঃ</b>{{ date('h:i:s A', strtotime($data->updated_at)) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>সরবরাহের গন্তব্যস্থলঃ</b>
                            <span style="width: 320px; display: inline-block;">{{ @$data->client->address }}</span>
                        </td>
                        <td width="220"></td>
                    </tr>
                    <tr>
                        <td><b>যানবাহনের প্রকৃতি ও নম্বরঃ</b>{{ @$data->deliveryList->delivery->vehicle->type }}
                        </td>
                        <td width="220"></td>
                    </tr>
                </table>
            </div>
        </header>
        <div class="chalan-body">
            <table class="content-table table table-bordered">
                <thead>
                    <tr>
                        <th>ক্রঃ <br> নং</th>
                        <th>পন্য বা সেবার বর্ণনা (প্রযোজ্য ক্ষেত্রে ব্র্যান্ড নামসহ)</th>
                        <th>ধরন</th>
                        <th>পরিমান</th>
                        <th>একক মূল্য <br> (টাকায়)</th>
                        <th>মোট মূল্য <br> (টাকায়)</th>
                        <th>সম্পূরক <br> শুল্কের <br> হার</th>
                        <th>সম্পূরক <br> শুল্কের <br> পরিমাণ <br> (টাকায়)</th>
                        <th>মূল্য <br> সংযোজন <br> করের হার/ <br> সুনির্দিষ্ট কর</th>
                        <th>মূল্য সংযোজন <br> কর/ <br> সুনির্দিষ্ট কর এর <br> পরিমাণ (টাকায়)</th>
                        <th>সকল প্রকার শুল্ক ও <br> করসহ মূল্য</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>(১)</th>
                        <th>(২)</th>
                        <th>(৩)</th>
                        <th>(৪)</th>
                        <th>(৫)</th>
                        <th>(৬)</th>
                        <th>(৭)</th>
                        <th>(৮)</th>
                        <th>(৯)</th>
                        <th>(১০)</th>
                        <th>(১১)</th>
                    </tr>
                    @php
                        $total_vat = 0;
                        $total_qty = 0;
                        $total_net_amount = 0;
                        $total_net_amount_with_vat = 0;
                    @endphp
                    @foreach ($data->list as $row)
                        @php
                            $net_amount = $row->amount - $row->discount;
                            $vat = ($net_amount / 100) * 15;
                            $total_amount = $net_amount + $vat;
                            $total_vat += $vat;
                            $total_qty += $row->qty;
                            $total_net_amount += $net_amount;
                            $total_net_amount_with_vat += $total_amount;
                        @endphp
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <th>{{ @$row->variant->product->name }}</th>
                            <th>{{ @$row->variant->sku }}</th>
                            <th>{{ number_format($row->qty, 2, '.', ',') }}</th>
                            <th>{{ number_format($row->rate, 2, '.', ',') }}</th>
                            <th>{{ number_format($row->amount - $row->discount, 2, '.', ',') }}</th>
                            <th></th>
                            <th></th>
                            <th>15%</th>
                            <th>{{ number_format($vat, 2, '.', ',') }}</th>
                            <th>{{ number_format($total_amount, 2, '.', ',') }}</th>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <th>{{ number_format($total_qty, 2, '.', ',') }}</th>
                        <th></th>
                        <th>{{ number_format($total_net_amount, 2, '.', ',') }}</th>
                        <th></th>
                        <th></th>
                        <th>15%</th>
                        <th>{{ number_format($total_vat, 2, '.', ',') }}</th>
                        <th>{{ number_format($total_net_amount_with_vat, 2, '.', ',') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <footer class="chalan-footer">
            <h3>প্রতিষ্ঠান কর্তৃপক্ষের দায়িত্বপ্রাপ্ত ব্যক্তির নামঃ</h3>
            <h3>পদবিঃ</h3>
            <h3>স্বাক্ষরঃ</h3>
            <h3>সীলঃ</h3>
        </footer>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
