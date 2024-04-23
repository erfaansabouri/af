<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">
<head>
    <title>به‌فروش</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="" type="image/x-icon"/>

    <meta name="keywords" content=""/>
    <meta name="description" content="">

    <meta property="og:site_name" content="به‌فروش">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image:secure_url" content=""/>
    <meta property="og:image" content=""/>

    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">

    <style>
        /* General ------------------------------------------------------------------------------------------------------------*/
        body {
            direction: rtl;
            font-family: 'dana', sans-serif;
        }

        * {
            font-family: 'dana', sans-serif;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        th, td {
            font-weight: normal;
            font-size: 12px;

        }

        .tbl-product > tr:nth-child(odd) {
            background: #E0E0E0
        }


        .dana-fa-number {
            font-family: 'dananumeric', sans-serif;
        }

        .table1 {
            text-align: right;
            border: 1px solid #333;
            border-radius: 10px !important;
        }

        th, td {
            padding: 5px;
        }

        .bg {
            background-color: #E0E0E0;
        }

        .img {
            height: 72px;
            width: 172px;
            margin-top: 10px;
            float: right;
            margin-right: 10px;
        }


        @media print {
            table {
                border-radius: 10px;
            }
        }
    </style>

</head>

<body>
<table class="table1" style="border: 1px solid #333;border-bottom: 1px solid #333; margin-top: 10px;border-radius: 10px; width: 100%;border-collapse: collapse">
    <thead>
    <tr>
        <th style="border-left: 1px solid #333;border-bottom: 1px solid #333" rowspan="4">
{{--
            <img width="65px" height="65px" src="{{ asset('metronic-assets/media/mini-logo.webp') }}">
--}}
        </th>
    </tr>
    <tr>
        <th style="border-bottom: 1px solid #333;" class="text-right" colspan="12">فرستنده: {{@$shop_setting->user->full_name}}</th>
    </tr>
    <tr>
        &nbsp;
    </tr>
    <tr>
        <th style="border-bottom: 1px solid #333;border-left: 1px solid #333" class="text-right dana-fa-number" colspan="6">شماره موبایل:
            <span dir="ltr">{{@$shop_setting->phone_one}}</span>
        </th>
        <th style="border-bottom: 1px solid #333;" class="text-right dana-fa-number " colspan="6">شماره ثابت:
            <span dir="ltr">{{@$shop_setting->phone_two}}</span>
        </th>
    </tr>
    <tr>
        <th style="border-bottom: 1px solid #333;" colspan="13" class="dana-fa-number text-right">آدرس: {{@$shop_setting->address}}</th>
    </tr>
    </thead>
</table>
<table class="table1" width="100%" style="border-collapse: collapse">
    <thead>
    <tr>
        <th style="border-bottom: 1px solid #333;" class="text-right dana-fa-number" colspan="13">گیرنده: {{@$invoice->invoiceAddress->recipient_name}}</th>
    </tr>
    <tr>
        <th style="border-bottom: 1px solid #333" class="text-right dana-fa-number" colspan="13">کد پستی: {{@$invoice->invoiceAddress->zip_code != null ? @$invoice->invoiceAddress->zip_code : '--'}}</th>
    </tr>
    <tr>
        <th style="border-bottom: 1px solid #333;border-left: 1px solid #333" class="text-right dana-fa-number" colspan="6">شماره موبایل: {{@$invoice->invoiceAddress->recipient_phone}}</th>
        <th style="border-bottom: 1px solid #333;border-left: 1px solid #333" class="text-right dana-fa-number" colspan="7">شماره ثابت: {{@$invoice->invoiceAddress->phone_number}}</th>
    </tr>
    <tr>
        <th style="border-bottom: 1px solid #333;" colspan="13" class="dana-fa-number text-right">آدرس: {{@$invoice->invoiceAddress->city->province->title}} - {{@$invoice->invoiceAddress->city->title}} - {{@$invoice->invoiceAddress->address}}</th>
    </tr>
    <tr>
        <th style="border-bottom: 1px solid #333;" colspan="13" class="dana-fa-number text-right">توضیحات: {{@$invoice->invoiceAddress->description}}</th>
    </tr>
    </thead>
</table>
</body>

</html>
