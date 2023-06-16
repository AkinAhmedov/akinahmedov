<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="{{$settings['description']}}" content="Laravel information">
    <meta name="{{$settings['keywords']}}" content="Laravel">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- For Window Tab Color -->
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#2c2c2c">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#2c2c2c">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#2c2c2c">

    <title>{{$settings['title']}} - Hakkında</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png"  href="{{asset('assets/images/fav-icon/favicon.png')}}">


    <!-- Main style sheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- responsive style sheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
    <!-- Theme-Color css -->
    <link rel="stylesheet" id="jssDefault" href="{{asset('assets/css/color.css')}}">


    <!-- Fix Internet Explorer ______________________________________-->

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="{{asset('assets/vendor/html5shiv.js')}}"></script>
    <script src="{{asset('assets/vendor/respond.js')}}"></script>
    <![endif]-->


</head>

<body>

<div class="main-page-wrapper">
    <!-- ===================================================
        Loading Transition
    ==================================================== -->
    <div id="loader-wrapper">
        <div id="loader">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>


    <!-- ===================================================
        About Me Wrapper
    ==================================================== -->
    <div class="about-me-wrapper">
        <div class="back-to-home"><a href="/"><i class="flaticon-left-arrow"></i> Anasayfa</a></div>
        <div class="main-text-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-12">
                        <h2>Akın Ahmedov</h2>
                        <h3>Yazılımcı</h3>
                        <div style="font-size: 14px; color: gray">CV mi <a href="/downloadCV" style="font-size: 16px">buradan </a> indirebilirsiniz...</div><br>
                        <p>Merhaba, ben Akın. 10 yıldır Oracle PL/SQL ve Oracle Forms geliştirme konusunda
                            deneyimliyim. Önceden 7 yıl başka bir yazılım şirketinde çalıştım ve şu anda 4 yıldır
                            bulunduğum şirkette Oracle veritabanı yönetimi, PL/SQL programlama ve Oracle Forms
                            geliştirme konularında uzmanlaşmış durumdayım. Kullanıcıların ihtiyaçlarını anlamak ve en
                            iyi çözümleri sunmak için çaba sarf ederim. Analitik düşünme becerilerim ve takım
                            çalışmasına yatkınlığım projelerin başarılı bir şekilde tamamlanmasına katkı sağlar. Yeni
                            teknolojilere adapte olmaya ve sürekli kendimi geliştirmeye önem veririm. Müşteri odaklı
                            yaklaşımım ve iletişim becerilerimle projelerde etkili bir şekilde çalışırım. Yazılım
                            dünyasındaki heyecan verici yolculuğuma sizleri de davet etmekten mutluluk duyarım! </p>
                        <ul>
                            <li><a href="{{$settings['facebook']}}"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{$settings['twitter']}}"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{$settings['google']}}"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="/contact"><i class="fas fa-at"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.about-me-wrapper -->


    <!-- Optional JavaScript _____________________________  -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- jQuery -->
    <script src="{{asset('assets/vendor/jquery.2.2.3.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('assets/vendor/popper.js/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Style-switcher  -->
    <script src="{{asset('assets/vendor/jQuery.style.switcher.min.js')}}"></script>
    <!-- jquery-easy-ticker-master -->
    <script src="{{asset('assets/vendor/jquery-easy-ticker-master/jquery.easy-ticker.min.js')}}"></script>
    <!-- jquery easing -->
    <script src="{{asset('assets/vendor/jquery.easing.1.3.js')}}"></script>
    <!-- Font Awesome -->
    <script src="{{asset('assets/fonts/font-awesome/fontawesome-all.min.js')}}"></script>
    <!-- menu  -->
    <script src="{{asset('assets/vendor/menu/src/js/jquery.slimmenu.js')}}"></script>
    <!-- owl.carousel -->
    <script src="{{asset('assets/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
    <!-- Fancybox -->
    <script src="{{asset('assets/vendor/fancybox/dist/jquery.fancybox.min.js')}}"></script>
    <!-- Youtube Video -->
    <script src="{{asset('assets/vendor/jquery.fitvids.js')}}"></script>
    <!-- Masonary js -->
    <script src="{{asset('assets/vendor/masonry.pkgd.min.js')}}"></script>

    <!-- Theme js -->
    <script src="{{asset('assets/js/theme.js')}}"></script>
</div> <!-- /.main-page-wrapper -->
</body>
</html>
