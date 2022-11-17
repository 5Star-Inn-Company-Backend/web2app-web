<!DOCTYPE html>
<html lang="zxx">


<head>
    <meta charset="utf-8">
    <title>Web2App</title>
    <link rel="icon" href="/images/w2a.jpg" type="image/gif" sizes="24x24">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Convert your website to an app &lt;/without coding&gt; online & within a minute" name="description">
    <meta content="web2app" name="keywords">
    <meta content="5star inn company" name="author">

    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <![endif]-->

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- CSS Files
    ================================================== -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap-reboot.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.theme.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.transitions.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/jquery.countdown.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fonts/font-awesome-5/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fonts/font-awesome-4/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fonts/font-awesome-5/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fonts/elegant_font/HTML_CSS/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fonts/et-line-font/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- color scheme -->
    <link id="colors" href="{{ asset('css/colors/scheme-07.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/coloring.css') }}" rel="stylesheet" type="text/css">

    <!-- RS5.0 Stylesheet -->
    <link href="{{ asset('revolution/css/settings.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('revolution/css/layers.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('revolution/css/navigation.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/rev-settings.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="dark-mode text-light disable-dark">
    <div id="wrapper">


        <!-- header begin -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="header-row">
                            <div class="header-col left">
                                <!-- logo begin -->
                                <div id="logo">
                                    <a href="/"><img alt="" class="logo" src="/images/w2a.jpg"
                                            width="50px" height="50px"> <img alt="" class="logo-2"
                                            src="/images/w2a.jpg" width="50px" height="50px"></a>
                                </div>
                                <!-- logo close -->
                            </div>
                            <div class="header-col mid">

                                <ul class="navbar-nav ms-auto">
                                    <!-- Authentication Links -->

                                    <!-- Right Side Of Navbar -->
                                    <ul class="navbar-nav ms-auto">
                                        <!-- Authentication Links -->
                                        @auth()
                                            <ul id="mainmenu">
                                                <li class="nav-item dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle"
                                                        href="#" role="button" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false" v-pre>
                                                        {{ Auth::user()->name }}
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-right"
                                                        aria-labelledby="navbarDropdown">
                                                        <a href="{{ route('changepass') }}" class="dropdown-item text-dark">Change
                                                            Password</a>

                                                        <a class="dropdown-item text-dark" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </li>


                                                <li><a href="{{ route('welcome') }}">Home</a></li>
                                                {{--                                <li><a href="{{ route('showstore') }}">Store</a></li> --}}
                                                <li><a href="{{ route('pricing') }}">Pricing</a></li>
                                                <li><a href="{{ route('feed') }}">Feedback</a></li>
                                                {{-- <li><a href="{{ route('login') }}">Login</a></li> --}}

                                                <div class="col-right">
                                                    <a class="btn-custom" href="{{ route('convert') }}"><i
                                                            class="fa fa-recycle"></i> Convert</a>
                                                </div>
                                            </ul>
                                        @else
                                            <ul id="mainmenu">

                                                @if (Route::has('login'))
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ route('login') }}">{{ __('Login') }}</a>
                                                    </li>
                                                @endif

                                                @if (Route::has('register'))
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                                    </li>
                                                @endif



                                            </ul>
                                        @endauth
                                    </ul>
                                </ul>
                                <!-- mainmenu begin -->

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- small button begin -->
                        <span id="menu-btn"></span>
                        <!-- small button close -->

                    </div>
                </div>
            </div>
        </header>
        <!-- header close -->
        <!-- content begin -->
        @yield('content')

        <!-- content close -->

        <!-- footer begin -->
        <footer>
            <div class="container">
                <div class="row">

                    <div class="col-md-8">
                        <div class="row">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="widget">
                            <a href="/"><img alt="" class="logo" src="/images/w2a.jpg"
                                    width="50px" height="50px"></a>
                            <div class="spacer-20"></div>
                            <p>Web2App offer service that converts your website into a fully functional mobile app for
                                Android, IOS, Windows, Linux in 5 minutes. We are here to solve the problem of mobile
                                app development complexity.</p>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 sm-text-center mb-sm-30">
                        <div class="mt10">&copy; Copyright {{ \Carbon\Carbon::now()->format('Y') }} - 5Star Inn
                            Company</div>
                    </div>

                    <div class="col-md-6 text-md-right text-sm-left">
                        <div class="social-icons">
                            <a href="https://facebook.com/5starcompany"><i class="fa fa-facebook fa-lg"></i></a>
                            <a href="mailto:info@5starcompany.com.ng"><i class="fa fa-envelope fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </footer>
        <!-- footer close -->

        <div id="preloader">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div>

    {{-- <div id="selector"> --}}
    {{--    <span class="opt tc1" data-color="scheme-01"></span> --}}
    {{--    <span class="opt tc2" data-color="scheme-02"></span> --}}
    {{--    <span class="opt tc3" data-color="scheme-03"></span> --}}
    {{--    <span class="opt tc4" data-color="scheme-04"></span> --}}
    {{--    <span class="opt tc5" data-color="scheme-05"></span> --}}
    {{--    <span class="opt tc6" data-color="scheme-06"></span> --}}
    {{--    <span class="opt tc7" data-color="scheme-07"></span> --}}

    {{--    <span id="dark-mode"> --}}
    {{--                Enable Dark Mode --}}
    {{--            </span> --}}

    {{--    <span id="related-items"> --}}
    {{--                Click For More --}}
    {{--            </span> --}}
    {{-- </div> --}}

    <div id="theme-select-wrapper">
        <div id="theme-select">
            <div id="html-loader"></div>
        </div>
    </div>

    <!-- Javascript Files
================================================== -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('js/easing.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/validation.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/enquire.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/jquery.plugin.js') }}"></script>
    <script src="{{ asset('js/typed.js') }}"></script>
    <script src="{{ asset('js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('js/designesia.js') }}"></script>

    <!-- RS5.0 Core JS Files -->
    <script src="{{ asset('') }}revolution/js/jquery.themepunch.tools.min838f.js?rev=5.0"></script>
    <script src="{{ asset('') }}revolution/js/jquery.themepunch.revolution.min838f.js?rev=5.0"></script>

    <!-- RS5.0 Extensions Files -->
    <script src="{{ asset('revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <!-- current page only scripts -->

    <script>
        jQuery(document).ready(function() {
            // revolution slider
            jQuery("#revolution-slider").revolution({
                sliderType: "standard",
                sliderLayout: "fullscreen",
                delay: 5000,
                navigation: {
                    arrows: {
                        enable: true
                    }
                },
                parallax: {
                    type: "mouse",
                    origo: "slidercenter",
                    speed: 2000,
                    levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
                },
                spinner: "off",
                gridwidth: 1140,
                gridheight: 600,
                disableProgressBar: "on"
            });
        });
    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/630b9ef654f06e12d8915d93/1gbim9t7e';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->


</body>



</html>
