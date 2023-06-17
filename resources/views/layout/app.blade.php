<!DOCTYPE html>
<div lang="en">
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

        <title>{{$settings['title']}}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{asset('assets/images/fav-icon/favicon.png')}}">


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

    <div>
        <div class="search-box" id="searchWrapper">
            <div id="close-button"></div>
            <div class="container">
                <form action="/search/keyword" method="post">
                    @csrf
                    <div class="input-wrapper">
                        <input type="text" placeholder="Aranacak Kelimeyi Yaz" id="keyword" name="keyword" autofocus
                               required>
                    </div>
                </form>
            </div>
        </div> <!-- /.search-box -->


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

            <!--
            =============================================
                Top Header
            ==============================================
            -->
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-12">
                            <div class="news-bell">Son Postlar :</div>
                            <div class="breaking-news easyTicker">
                                <div class="wrapper">
                                    @foreach($lastestPosts as $post)
                                        <div class="list"><a href="/post/detail/{{$post->id}}">{{$post->title}}</a>
                                        </div>
                                    @endforeach
                                </div> <!-- /.wrapper -->
                            </div> <!-- /.breaking-news -->
                        </div>
                        <div class="col-lg-4 col-12">
                            <ul class="social-icon text-right">
                                <li class="icon"><a href="{{$settings['facebook']}}"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li class="icon"><a href="{{$settings['twitter']}}"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li class="icon"><a href="{{$settings['google']}}"><i class="fab fa-google-plus-g"></i></a>
                                </li>
                                <li class="icon"><a href="{{$settings['linkedin']}}"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                                <li class="search-button">
                                    <button class="search" id="search-button"><i class="fas fa-search"></i></button>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.container -->
            </div> <!-- /.top-header -->


            <!--
            =============================================
                Theme Header
            ==============================================
            -->
            <header class="theme-main-header">
                <div class="container">
                    <div class="content-holder clearfix">
                        <div class="logo"><a href="/"><img src="{{asset('assets/images/logo/logo.png')}}" alt=""></a>
                        </div>
                        <!-- ============== Menu Warpper ================ -->
                        <div class="menu-wrapper">
                            <nav id="mega-menu-holder" class="clearfix">
                                <ul class="clearfix">
                                    <li class="active"><a href="/">Anasayfa</a></li>
                                    <li><a href="#">Kategoriler</a>
                                        <ul class="dropdown">
                                            @foreach($catParent0 as $category)
                                                <li>
                                                    <a href="{{(count($category->childs) ? '#' : '/search/category/'.$category->id)}}">{{$category->category}}</a>
                                                    @if(count($category->childs))
                                                        @include('manage_childs',['childs' => $category->childs])
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="/about">Hakkımda</a></li>
                                    <li><a href="/contact">İletişim</a></li>
                                </ul>
                            </nav> <!-- /#mega-menu-holder -->
                        </div> <!-- /.menu-wrapper -->
                    </div> <!-- /.content-holder -->
                </div> <!-- /.container -->
            </header> <!-- /.theme-main-header -->


            @yield('content')


            <!-- ======================== Theme Sidebar =============================== -->
            <div class="col-lg-4 col-md-7 col-12 theme-main-sidebar">
                @if($_SERVER['REQUEST_URI'] == '/')
                    <div class="sidebar-box bg-box about-me">
                        <h6 class="sidebar-title">Hakkımda</h6>
                        <img src="{{asset('assets/images/home/1.jpeg')}}" alt=""> <!-- 290x305 -->
                        <p>Merhaba! Ben Akın Ahmedov. 10 yıllık Oracle PL/SQL ve Oracle Forms geliştirme tecrübesine
                            sahibim. Müşteri odaklı çözümler üretme konusunda uzmanlaştım. Tutkulu, analitik düşünce
                            yeteneğine sahip ve sürekli öğrenmeye açık biriyim. İletişim becerilerimle takım çalışmasına
                            katkı sağlarım. Heyecan verici yazılım projelerinde yer almaktan mutluluk duyarım.</p>
                        <div class="clearfix"><img src="assets/images/home/sign.png" alt=""
                                                   class="signature float-right">
                        </div>
                    </div> <!-- /.about-me -->
                @endif
                <div class="sidebar-box bg-box sidebar-categories">
                    <h6 class="sidebar-title">Kategoriler</h6>
                    <ul>
                        @foreach($catParent0 as $category)
                            <li><a href="/search/category/{{$category->id}}">{{$category->category}}</a></li>
                        @endforeach
                    </ul>
                </div> <!-- /.sidebar-categories -->
                <!-- Trending Post alanı buradan cıkartıldı -->
                <div class="sidebar-box bg-box sidebar-categories">
                    <h6 class="sidebar-title">Arşiv</h6>
                    <ul>
                        @foreach($postsDateDistinct as $item)
                            <li><a href="/search/date/{{$item}}">{{$item}}</a></li>
                        @endforeach
                    </ul>
                </div> <!-- /.sidebar-categories -->
                <div class="sidebar-box bg-box sidebar-tags">
                    <h6 class="sidebar-title">Tag</h6>
                    <ul class="clearfix">
                        @foreach(explode(',', $tags) as $tag)
                            <li><a href="/search/tag/{{$tag}}">{{$tag}}</a></li>
                        @endforeach
                    </ul>
                </div> <!-- /.sidebar-tags -->
                <div class="sidebar-box bg-box sidebar-newsletter">
                    <h6 class="sidebar-title">Abone</h6>
                    <form action="/subscribe" method="post">
                        @csrf
                        <input type="email" name="email" placeholder="Email" required>
                        <button type="submit" class="theme-button-one">Abone Ol</button>
                    </form>
                </div> <!-- /.sidebar-newsletter -->
            </div> <!-- /.theme-main-sidebar -->
        </div>
    </div>
    <!--
    =====================================================
        Footer
    =====================================================
    -->
    <footer class="theme-footer">
        <div class="container">
            <div class="logo"><a href="/"><img src="{{asset('assets/images/logo/altLogo.png')}}" alt=""></a></div>
            <p class="footer-text">Blog ve CV Sitesidir.</p>
            <ul class="social-icon">
                <li class="icon"><a href="{{$settings['facebook']}}"><i class="fab fa-facebook-f"></i></a></li>
                <li class="icon"><a href="{{$settings['twitter']}}"><i class="fab fa-twitter"></i></a></li>
                <li class="icon"><a href="{{$settings['google']}}"><i class="fab fa-google-plus-g"></i></a></li>
                <li class="icon"><a href="{{$settings['linkedin']}}"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
            <p class="copyright">{{$settings['copyright']}}</p>
        </div> <!-- /.container -->
    </footer> <!-- /.theme-footer -->


    <!-- Scroll Top Button -->
    <button class="scroll-top tran3s">
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </button>

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
    <!-- menu  -->
    <script src="{{asset('assets/vendor/menu/src/js/jquery.slimmenu.js')}}"></script>
    <!-- owl.carousel -->
    <script src="{{asset('assets/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
    <!-- Fancybox -->
    <script src="{{asset('assets/vendor/fancybox/dist/jquery.fancybox.min.js')}}"></script>
    <!-- Youtube Video -->
    <script src="{{asset('assets/vendor/jquery.fitvids.js')}}"></script>

    <!-- Theme js -->
    <script src="{{asset('assets/js/theme.js')}}"></script>
</div> <!-- /.main-page-wrapper -->
</body>
</html>
