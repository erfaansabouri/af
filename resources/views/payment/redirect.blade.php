<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>آفتاب</title>
    <style>
        body {
            font-family: dana !important;
            direction: rtl;
            background-color: #ffffff;
            margin: 0;
        }

        h1, h2, h3, h4, h5, h6, input, textarea {
            font-family: dana !important;
        }

        .text-box {
            font-size: 20px;
            color: #336e52;
            margin-top: 30px;
            text-align: center;
            font-weight: 500;
            padding: 0 25px;
        }
        .text-box-failed {
            font-size: 20px;
            color: #336e52;
            margin-top: 30px;
            text-align: center;
            font-weight: 500;
            padding: 0 25px;
        }

        .logo img {
            margin: auto;
            display: block;
            max-width: 78px;
            margin-top: 100px;
        }
    </style>
</head>
<body>
<div class="logo">
    <img src="{{asset("metronic-assets/media/logo.png")}}" alt="logo">
</div>

@if(isset($success))
    <div class="text-box">
        پرداخت شما با موفقیت انجام شد.
        <br>
        کد پیگیری
        {{ @$code }}
        <br>
        با تشکر از پرداخت شما
    </div>
@endif


@if(isset($failed))
    <div class="text-box">
        پرداخت با شکست مواجه شد
        <br>
        {{ @$failed_message }}
        <br>
        {{ @$failed_code }}
    </div>
@endif
<div class="text-box">
بازگشت به وبسایت
    <a href="{{ route('home') }}">کلیک کنید</a>
</div>
</body>
</html>
