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

    <title>{{$settings['title']}} - İletişim</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="35x35" href="{{asset('assets/images/fav-icon/favicon.png')}}">


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
    <div class="contact-us">
        <div class="back-to-home"><a href="/"><i class="flaticon-left-arrow"></i> Anasayfa</a></div>
        <div class="main-text-wrapper">
            <div class="container">
                <div class="contact-form">
                    <h2>Iletisim</h2>
                    <p>Herhangi bir konu hakkında benimle iletişime geçebilirsiniz</p>
                    <form action="/contact" method="post" class="form-validation">
                        @csrf
                        <label>İsim</label>
                        <input type="text" placeholder="Akın Ahmedov" name="name" autofocus required>
                        <label>Email</label>
                        <input type="email" placeholder="emailadresi@ornek.com" name="email" required>
                        <label>Mesaj</label>
                        <textarea placeholder="Mesaj" name="message" required></textarea>
                        <button type="submit" class="theme-button-one">Gönder</button>
                    </form>
                </div> <!-- /.contact-form -->
            </div> <!-- /.container -->
        </div> <!-- /.main-text-wrapper -->
        <!--Contact Form Validation Markup -->
        <!-- Contact alert -->
        <div class="alert-wrapper" id="alert-success">
            <div id="success">
                <button class="closeAlert"><i class="fas fa-window-close"></i></button>
                <div class="wrapper">
                    <p>Your message was sent successfully.</p>
                </div>
            </div>
        </div> <!-- End of .alert_wrapper -->
        <div class="alert-wrapper" id="alert-error">
            <div id="error">
                <button class="closeAlert"><i class="fas fa-window-close"></i></button>
                <div class="wrapper">
                    <p>Sorry!Something Went Wrong.</p>
                </div>
            </div>
        </div> <!-- End of .alert_wrapper -->
    </div> <!-- /.contact-us -->



    @if(session('Status'))
        <style>
            .swal2-popup {
                border: 1px solid #d0344e;
                background-color: #212121;
                border-radius: 0;
            }

            .swal2-popup .swal2-styled.swal2-confirm {
                border: 1px solid #1d1d1d;
                background-color: #d0344e !important;
            }

            .swal2-popup .swal2-styled.swal2-confirm:focus {
                outline: 0;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire(
                "{{session('Title')}}",
                "{{session('Message')}}",
                "{{session('Status')}}",
            )
        </script>
    @endif
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
    <!-- Validation -->
    <script type="text/javascript" src="{{asset('assets/vendor/contact-form/validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/contact-form/jquery.form.js')}}"></script>

    <!-- Theme js -->
    <script src="{{asset('assets/js/theme.js')}}"></script>
</div> <!-- /.main-page-wrapper -->
</body>
</html>
