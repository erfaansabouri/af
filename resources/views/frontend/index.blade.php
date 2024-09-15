<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>آفتاب فارس - مجتمع تجاری اداری آفتاب فارس</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/lightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}" />
</head>
<body id="home">

    <header id="navbar">
        <div id="logo">
            <h4><a href="{{ route('home') }}"><img height="50" src="{{ asset('metronic-assets/media/minimal-logo.png') }}" alt=""></a></h4>
        </div>
        <div id="toggler">
            <i class="fa fa-bars"></i>
        </div>
        <nav id="nav">
            <ul class="list-unstyled">
                <li><a href="{{ route('home') }}">خانه</a></li>
                <li><a href="{{ route('tenant.auth.login-form') }}">پنل کاربری واحد ها</a></li>
                <li><a href="{{ route('other.auth.login-form') }}">پنل کاربری متفرقه ها</a></li>
            </ul>
        </nav>
    </header>

    <section id="slider">
        <div id="top-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="background-image: url('{{ asset('frontend/aftab/i1.webp') }}')">
                    <div class="carousel-overlay">
                        <div class="carousel-content text-center">
                            <h2 class="carousel-title">مجتمع تجاری اداری آفتاب فارس</h2>
                            <p class="carousel-text">مهم نیست در کجای شیراز ساکن هستید ، در هرنقطه این شهر بزرگ باشید تا این مرکز در یکی از بهترین نقاط تجاری، اداری دسترسی آسان دارید.
                                                     جشنواره ای از بهترین برندهای داخلی و خارجی بطور دائم برای شما مشتری گرامی به نمایش گذاشته شده است.
                                                     فرصت پاساژگردی و خدمات اداری هیجان انگیز را در اختیار گردشگران و همشهریان عزیز قرار داده است.</p>
                        </div>
                    </div>
                </div>

                <a class="carousel-control-prev" href="#top-carousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#top-carousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

                <ol class="carousel-indicators">
                    <li data-target="#top-carousel" data-slide-to="0" class="active"></li>
                </ol>

            </div>
        </div>
    </section>


    <section id="services">
        <div class="container">
            <header class="section-header">
                <h3>درباره ما</h3>
                <p>پیش بینی ساخت مجتمع در مکان فعلی توسط کمیته اقتصادی امام (ره) از سال 1369 مد نظر ولی نهایتا در سال 1385 سازه اصلی تکمیل و بطور رسمی از سال 1388 مجتمع تجاری اداری آفتاب فارس افتتاح گردید. مجتمع در مساحتی در حدود 5000 متر و در 9 طبقه ساخته شد. 3 طبقه واحدهای اداری (78 واحد) ، 3 طبقه واحدهای تجاری (276 واحد) ، 2 طبقه پارکینگ بهمراه 198 انباری مجزا و یک طبقه با 54 انباری .
                   مجتمع مجهز به 7 آسانسور ، 4 پله برقی ، 3 درب ورودی ،2 پله اضطراری می باشد. نمای مجتمع ترکیبی از شیشه و کامپوزیت و سنگ سبز گرانیتی وارداتی می باشد.
                   مجتمع مجهز به سیستم گرمایش و سرمایش مرکزی ، سیستم آتش نشانی تر و خشک ، سیستم اعلام حریق مرکزی(آدرس پذیر) ، سیستم صوتی مرکزی و همچنین جنراتور اضطراری می باشد.
                   مجتمع با فضای در حدود 550 متر نورگیر حیاط مرکزی جلوه ای خاص و مدرنی را در اختیار بازدید کنندگان خود قرار می دهد.
                   وجود کافی شاپ ، فست فود و انواع غرفه های خوراکی فضای آرام و دلنشینی را محیا مشتریان خود می نماید.</p>
            </header>
            <div class="row">
                <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.5s">
                    <div class="float-right text-success"><i class="fa fa-line-chart fa-2x"></i></div>
                    <h4>تجاری</h4>
                    <p class="description"> آفتاب فارس یکی از پرمتنوع ترین فروشگاه ها و گروه های کالایی را دارا میباشد که هر نیازی را پوشش میدهد </p>
                </div>
                <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.5s">
                    <div class="float-right text-success"><i class="fa fa-book fa-2x"></i></div>
                    <h4>تفریحی</h4>
                    <p class="description"> اگر به دنبال یک مکان ایده آل برای تفریح هستید ما به شما آفتاب فارس را پیشنهاد میدهیم </p>
                </div>
                <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.5s">
                    <div class="float-right text-success"><i class="fa fa-envelope fa-2x"></i></div>
                    <h4>اداری</h4>
                    <p class="description"> آفتاب فارس کاملترین مجتمع اداری در سه طبقه فوقانی را دارا میباشد </p>
                </div>
                <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.5s">
                    <div class="float-right text-success"><i class="fa fa-address-book-o fa-2x"></i></div>
                    <h4>ساعت کاری</h4>
                    <p class="description"> ساعت کار مجتمع: صبح ها از ساعت 10 الی 14 - عصر ها از ساعت 17 الی 23 </p>
                </div>
                <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.5s">
                    <div class="float-right text-success"><i class="fa fa-address-card-o fa-2x"></i></div>
                    <h4>واحد ها</h4>
                    <p class="description"> ۲۷۳ واحد تجاری در ۳ طبقه و ۷۸ واحد اداری در ۳ طبقه </p>
                </div>
                <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.5s">
                    <div class="float-right text-success"><i class="fa fa-chain-broken fa-2x"></i></div>
                    <h4>پارکینگ</h4>
                    <p class="description"> پارکینگ با دسترسی آسان در ۲ طبقه </p>
                </div>
            </div>
        </div>
    </section>


    <section id="team">
        <div class="container">
            <header class="section-header wow fadeInUp">
                <h3>محیط مجتمع</h3>
                <p></p>
            </header>
            <div class="row">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-offset="150">
                    <div class="card">
                        <img src="{{ asset('frontend/aftab/i3.jpeg') }}" class="card-img-top" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s" data-wow-offset="150">
                    <div class="card">
                        <img src="{{ asset('frontend/aftab/i4.jpeg') }}" class="card-img-top" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s" data-wow-offset="150">
                    <div class="card">
                        <img src="{{ asset('frontend/aftab/i5.jpeg') }}" class="card-img-top" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s" data-wow-offset="150">
                    <div class="card">
                        <img src="{{ asset('frontend/aftab/i6.jpeg') }}" class="card-img-top" />
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer id="footer" class="text-light text-justify">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h5>درباره آفتاب فارس</h5>
                    <p>مجتمع تجاری آفتاب فارس یکی از بزرگتری و پر متنوع ترین مراکز خرید،تفریحی و گردشگری در استان فارس و شهر شیراز میباشد</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>پیوندهای مفید</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-angle-left"></i><a href="{{ route('home') }}">خانه</a></li>
                        <li><i class="fa fa-angle-left"></i><a href="{{ route('tenant.auth.login-form') }}">پنل کاربری واحد ها</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>تماس با ما</h5>
                    <p>
                        آدرس : شیراز
                        پل معالی آباد ، بلوار دکتر شریعتی ، نبش رهبر ماه
                        مجتمع تجاری و اداری آفتاب فارس
                    </p>
                    <p>
                        <strong>تلفن : </strong><span style="direction: ltr;display: inline-block">
                             ۳۶۳۵۴۳۷۰</span><br />
                    </p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>نماد ها</h5>
                    <p>
                        <a referrerpolicy='origin' target='_blank' href='https://trustseal.enamad.ir/?id=494324&Code=B37eubN2jNq4RJWPfvZ5q3jsR83vP4b4'><img referrerpolicy='origin' src='https://trustseal.enamad.ir/logo.aspx?id=494324&Code=B37eubN2jNq4RJWPfvZ5q3jsR83vP4b4' alt='' style='cursor:pointer' code='B37eubN2jNq4RJWPfvZ5q3jsR83vP4b4'></a>
                    </p>
                </div>
            </div>
        </div>
        <div style="background-color: black;">
            <p class="text-center p-3 mb-0">کلیه حقوق برای مجتمع تجاری اداری آفتاب فارس محفوظ است.</p>
        </div>
    </footer>

    <a href="#home" id="go-to-top">
        <i class="fa fa-chevron-up"></i>
    </a>



    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/counterup.min.js') }}"></script>
    <script src="{{{ asset('frontend/js/scripts.js') }}}"></script>
</body>
</html>
