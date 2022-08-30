@extends('include.layouts')

@section('content')
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- revolution slider begin -->
        <section aria-label="section-slider" class="fullwidthbanner-container" id="section-slider">
            <div id="revolution-slider">
                <ul>
                    <li data-masterspeed="1500" data-slotamount="10" data-transition="fade">
                        <!--  BACKGROUND IMAGE -->
                        <img alt="" class="rev-slidebg" data-bgparallax="0" data-bgposition="center center" data-duration="20000" data-ease="Power1.easeOut" data-kenburns="off" data-lazyload="images/slider/3.jpg" data-no-retina="" data-offsetend="0 0" data-offsetstart="0 0" data-rotateend="0" data-rotatestart="0" data-scaleend="100" data-scalestart="110" src="images/slider/3.jpg">

                        <div class="tp-caption custom-font-3" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1000" data-transform_in="y:-100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:-20;s:500;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="600" data-y="200">
                            Web<span class="id-color-2">2</span>App
                        </div>
                        <div class="tp-caption custom-font-1" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="700" data-transform_in="y:-100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:-20;s:700;e:Power2.easeInOut;" data-whitespace="wrap" data-width="550" data-x="600" data-y="center">
                            Convert your website to an app &lt;/without coding&gt; online & within a minute.
                        </div>
                        <div class="tp-caption tp-text text-left" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1300" data-transform_in="y:100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:30;s:700;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="600" data-y="380">
                            <a class="btn-slider" href="{{route('convert')}}">Convert Website Now</a>
                        </div>
                        <div class="tp-caption tp-text text-left" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1000" data-transform_in="y:100;s:0;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:0;s:700;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="0" data-y="bottom">
                            <img src="images/slider/server-2.png" alt="">
                        </div>

                    </li>

                    <li data-masterspeed="1500" data-slotamount="10" data-transition="fade">
                        <!--  BACKGROUND IMAGE -->
                        <img alt="" class="rev-slidebg" data-bgparallax="0" data-bgposition="center center" data-duration="20000" data-ease="Power1.easeOut" data-kenburns="off" data-lazyload="images/slider/6.jpg" data-no-retina="" data-offsetend="0 0" data-offsetstart="0 0" data-rotateend="0" data-rotatestart="0" data-scaleend="100" data-scalestart="110" src="images/slider/1.jpg">

                        <div class="tp-caption custom-font-3" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1000" data-transform_in="y:-100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:-20;s:500;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="0" data-y="200">
                            Web<span class="id-color-2">2</span>App
                        </div>
                        <div class="tp-caption custom-font-1" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="700" data-transform_in="y:-100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:-20;s:700;e:Power2.easeInOut;" data-whitespace="wrap" data-width="550" data-x="0" data-y="center">
                            ANDROID <span class="id-color-2">-</span> IOS <span class="id-color-2">-</span> WINDOWS <span class="id-color-2">-</span> LINUX
                        </div>
                        <div class="tp-caption tp-text text-left" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1300" data-transform_in="y:100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:30;s:700;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="0" data-y="380">
                            <a class="btn-slider" href="{{route('convert')}}">Convert Website Now</a>
                        </div>
                        <div class="tp-caption tp-text text-left" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1000" data-transform_in="y:100;s:0;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:0;s:700;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="600" data-y="bottom">
                            <img src="images/slider/server-2.png" alt="">
                        </div>
                    </li>

                    <li data-masterspeed="1500" data-slotamount="10" data-transition="fade">
                        <!--  BACKGROUND IMAGE -->
                        <img alt="" class="rev-slidebg" data-bgparallax="0" data-bgposition="center center" data-duration="20000" data-ease="Power1.easeOut" data-kenburns="off" data-lazyload="images/slider/4.jpg" data-no-retina="" data-offsetend="0 0" data-offsetstart="0 0" data-rotateend="0" data-rotatestart="0" data-scaleend="100" data-scalestart="110" src="images/slider/4.jpg">

                        <div class="tp-caption custom-font-3" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1000" data-transform_in="y:-100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:-20;s:500;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="600" data-y="200">
                            Web<span class="id-color-2">2</span>App
                        </div>
                        <div class="tp-caption custom-font-1" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="700" data-transform_in="y:-100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:-20;s:700;e:Power2.easeInOut;" data-whitespace="wrap" data-width="550" data-x="600" data-y="center">
                            Give your users a better experience using your site by getting instant access
                        </div>
                        <div class="tp-caption tp-text text-left" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1300" data-transform_in="y:100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:30;s:700;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="600" data-y="380">
                            <a class="btn-slider" href="{{route('convert')}}">Convert Website Now</a>
                        </div>
                        <div class="tp-caption tp-text text-left" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1000" data-transform_in="y:100;s:0;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:0;s:700;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="0" data-y="bottom">
                            <img src="images/slider/server-2.png" alt="">
                        </div>

                    </li>

                    <li data-masterspeed="1500" data-slotamount="10" data-transition="fade">
                        <!--  BACKGROUND IMAGE -->
                        <img alt="" class="rev-slidebg" data-bgparallax="0" data-bgposition="center center" data-duration="20000" data-ease="Power1.easeOut" data-kenburns="off" data-lazyload="images/slider/6.jpg" data-no-retina="" data-offsetend="0 0" data-offsetstart="0 0" data-rotateend="0" data-rotatestart="0" data-scaleend="100" data-scalestart="110" src="images/slider/1.jpg">

                        <div class="tp-caption custom-font-3" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1000" data-transform_in="y:-100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:-20;s:500;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="0" data-y="200">
                            Web<span class="id-color-2">2</span>App
                        </div>
                        <div class="tp-caption custom-font-1" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="700" data-transform_in="y:-100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:-20;s:700;e:Power2.easeInOut;" data-whitespace="wrap" data-width="550" data-x="0" data-y="center">
                            Create App online without coding experience for your website in less than 10 minutes.
                        </div>
                        <div class="tp-caption tp-text text-left" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1300" data-transform_in="y:100px;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:30;s:700;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="0" data-y="380">
                            <a class="btn-slider" href="{{route('convert')}}">Convert Website Now</a>
                        </div>
                        <div class="tp-caption tp-text text-left" data-height="none" data-responsive_offset="on" data-splitin="none" data-splitout="none" data-start="1000" data-transform_in="y:100;s:0;opacity:0;s:800;e:Power2.easeOut;" data-transform_out="opacity:0;y:0;s:700;e:Power2.easeInOut;" data-whitespace="nowrap" data-width="none" data-x="600" data-y="bottom">
                            <img src="images/slider/server-2.png" alt="">
                        </div>
                    </li>



                </ul>
            </div>
        </section>

        <section id="section-highlight">

            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb30 wow fadeInRight" data-wow-delay=".5s">
                        <div class="feature-box-type-1">
                            <i class="icon-alarmclock"></i>
                            <div class="text">
                                <h3>AUTO UPDATING</h3>Apps keep itself always synchronized with latest content from your website. All changes refletcs live!
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30 wow fadeInRight" data-wow-delay=".75s">
                        <div class="feature-box-type-1 hover">
                            <i class="icon-profile-male"></i>
                            <div class="text">
                                <h3 class="">Native UI</h3>Provide a rich native app experience with a launch splash image, navigation menu, tab menus, Dark Mode, and more
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30 wow fadeInRight" data-wow-delay="1s">
                        <div class="feature-box-type-1">
                            <i class="icon-refresh"></i>
                            <div class="text">
                                <h3>Push notifications</h3>Get out of your users’ mailboxes and send messages directly to the phone to increase user engagement.
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb30 wow fadeInRight" data-wow-delay=".7s">
                        <div class="feature-box-type-1">
                            <i class="icon-tools-2"></i>
                            <div class="text">
                                <h3>NO CODING REQUIRED</h3>You NEVER need to learn coding, complete process is automated, you are a few clicks away from your app.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30 wow fadeInRight" data-wow-delay=".95s">
                        <div class="feature-box-type-1">
                            <i class="icon-layers"></i>
                            <div class="text">
                                <h3 class="">MONETIZE WITH ADMOB</h3>Add your own AdMob banner to your App and generate revenue from it.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30 wow fadeInRight" data-wow-delay="1.2s">
                        <div class="feature-box-type-1">
                            <i class="icon-shield"></i>
                            <div class="text">
                                <h3>Native Tabs Menu</h3>Add a bottom menu with links to leading pages for users convenience.
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb30 wow fadeInRight" data-wow-delay=".7s">
                        <div class="feature-box-type-1">
                            <i class="icon-tools-2"></i>
                            <div class="text">
                                <h3>Set your own icon</h3>Set the icon of your App from your company or your organization logo.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30 wow fadeInRight" data-wow-delay=".95s">
                        <div class="feature-box-type-1">
                            <i class="icon-layers"></i>
                            <div class="text">
                                <h3 class="">Splash Screen</h3>Your app comes with splashscreen with your uploaded logo and primary color.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb30 wow fadeInRight" data-wow-delay=".75s">
                        <div class="feature-box-type-1 hover">
                            <i class="icon-profile-male"></i>
                            <div class="text">
                                <h3 class="">24/7 Support</h3>You can always reach our support team at info@5starcompany.com.ng
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

{{--        <section class="bgcolor-variation">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-8 offset-md-2">--}}
{{--                        <form action='https://www.designesia.com/themes/uhost/blank.php' class="row" id='form_sb' method="post" name="myForm">--}}
{{--                            <div class="col text-center">--}}
{{--                                <h2>Find your perfect domain name</h2>--}}
{{--                                <div class="spacer-10"></div>--}}
{{--                                <input class="form-control" id='name_1' name='name_1' placeholder="enter domain name" type='text'> <a href="search-results.html" id="btn-submit"><i class="arrow_right"></i></a>--}}

{{--                                <div class="clearfix"></div>--}}
{{--                                <div class="spacer-10"></div>--}}
{{--                                <div class="domain-ext">--}}
{{--                                    <div class="ext">--}}
{{--                                        <h4 class="id-color-2">.com</h4> $4.99/year--}}
{{--                                    </div>--}}

{{--                                    <div class="ext">--}}
{{--                                        <h4 class="id-color-2">.net</h4> $3.99/year--}}
{{--                                    </div>--}}

{{--                                    <div class="ext">--}}
{{--                                        <h4 class="id-color-2">.co</h4> $2.99/year--}}
{{--                                    </div>--}}

{{--                                    <div class="ext">--}}
{{--                                        <h4 class="id-color-2">.info</h4> $3.90/year--}}
{{--                                    </div>--}}

{{--                                    <div class="ext">--}}
{{--                                        <h4 class="id-color-2">.biz</h4> $5.99/year--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

{{--        <section aria-label="section">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="col-md-12 wow fadeInUp" data-wow-delay="0s">--}}
{{--                            <div id="owl-logo" class="logo-carousel owl-carousel owl-theme">--}}
{{--                                <img src="images/os/android.png" class="img-fluid" alt="android">--}}
{{--                                <img src="images/os/ios.png" class="img-fluid" alt="ios">--}}
{{--                                <img src="images/os/window.png" class="img-fluid" alt="window">--}}
{{--                                <img src="images/os/linux.png" class="img-fluid" alt="linux">--}}
{{--                                <img src="images/logo/5.png" class="img-fluid" alt="linux">--}}
{{--                                <img src="" class="img-fluid" alt="">--}}
{{--                                <img src="" class="img-fluid" alt="">--}}
{{--                                <img src="images/logo-white/1.png" class="img-fluid" alt="">--}}
{{--                                <img src="images/logo-white/2.png" class="img-fluid" alt="">--}}
{{--                                <img src="images/logo-white/3.png" class="img-fluid" alt="">--}}
{{--                                <img src="images/logo-white/4.png" class="img-fluid" alt="">--}}
{{--                                <img src="images/logo-white/5.png" class="img-fluid" alt="">--}}
{{--                                <img src="images/logo-white/6.png" class="img-fluid" alt="">--}}
{{--                                <img src="images/logo-white/7.png" class="img-fluid" alt="">--}}
{{--                                <img src="images/logo-white/8.png" class="img-fluid" alt="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

{{--        <section id="pricing-table" class="pb40 bgcolor-variation">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-12 wow fadeInUp">--}}
{{--                        <div class="text-center">--}}
{{--                            <h2><span class="uptitle id-color-2">Select Your</span>Hosting Plan</h2>--}}
{{--                            <div class="spacer-20"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0s">--}}
{{--                        <div class="pricing-s2 mb30">--}}
{{--                            <div class="top">--}}
{{--                                <img src="images/icon-w-shared-hosting.png" class="size96" alt="">--}}
{{--                                <div class="inner">--}}
{{--                                    <div class="clearfix"></div>--}}
{{--                                    <h2 class="id-color-2">Shared Hosting</h2>--}}
{{--                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>--}}
{{--                                    <p class="price"><span class="txt">Start from</span><span class="currency">$</span>--}}
{{--                                        <span class="num opt-1">5.59</span>--}}
{{--                                        <span class="num opt-2">3.45</span>--}}
{{--                                        <span class="month">p/mo</span></p>--}}
{{--                                    <a href="#" class="btn-custom">Sign Up Now</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay=".5s">--}}
{{--                        <div class="pricing-s2 mb30">--}}
{{--                            <div class="ribbon s2">HOT</div>--}}
{{--                            <div class="inner">--}}
{{--                                <div class="top">--}}
{{--                                    <img src="images/icon-w-vps-hosting.png" class="size96" alt="">--}}
{{--                                    <div class="clearfix"></div>--}}
{{--                                    <h2 class="id-color-2">VPS Hosting</h2>--}}
{{--                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>--}}
{{--                                    <p class="price"><span class="txt">Start from</span><span class="currency">$</span>--}}
{{--                                        <span class="num opt-1">14.75</span>--}}
{{--                                        <span class="num opt-2">12.25</span>--}}
{{--                                        <span class="month">p/mo</span></p>--}}
{{--                                    <a href="#" class="btn-custom secondary">Sign Up Now</a>--}}
{{--                                    <div class="clearfix"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="1s">--}}
{{--                        <div class="pricing-s2 mb30">--}}
{{--                            <div class="inner">--}}
{{--                                <div class="top">--}}
{{--                                    <img src="images/icon-w-cloud-hosting.png" class="size96" alt="">--}}
{{--                                    <div class="clearfix"></div>--}}
{{--                                    <h2 class="id-color-2">Cloud Hosting</h2>--}}
{{--                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>--}}
{{--                                    <p class="price"><span class="txt">Start from</span><span class="currency">$</span>--}}
{{--                                        <span class="num opt-1">18.65</span>--}}
{{--                                        <span class="num opt-2">16.35</span>--}}
{{--                                        <span class="month">p/mo</span></p>--}}
{{--                                    <a href="#" class="btn-custom mb10">Sign Up Now</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-12">--}}
{{--                        <div class="switch-set text-center wow fadeInUp" data-wow-delay=".2s">--}}
{{--                            <div>Monthly plan</div>--}}
{{--                            <div>--}}
{{--                                <input id="sw-1" class="switch" type="checkbox" />--}}
{{--                            </div>--}}
{{--                            <div>Yearly plan</div>--}}
{{--                            <div class="spacer-20"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

{{--        <section id="section-features">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md text-center wow fadeInUp">--}}
{{--                        <h2><span class="uptitle id-color-2">Build For Speed</span>Hosting Features</h2>--}}
{{--                        <div class="spacer-20"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md col-sm-6 mb-sm-30 wow zoomIn" data-wow-delay="0s">--}}
{{--                        <div class="feature-box-type-2 id-color-2">--}}
{{--                            <i class="icon-alarmclock"></i>--}}
{{--                            <h4>Instant Activation</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md col-sm-6 mb-sm-30 wow zoomIn" data-wow-delay=".2s">--}}
{{--                        <div class="feature-box-type-2 id-color-2">--}}
{{--                            <i class="icon-profile-male"></i>--}}
{{--                            <h4>24 / 7 Support</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md col-sm-6 mb-sm-30 wow zoomIn" data-wow-delay=".4s">--}}
{{--                        <div class="feature-box-type-2 id-color-2">--}}
{{--                            <i class="icon-refresh"></i>--}}
{{--                            <h4>99.9% Uptime</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md col-sm-6 mb-sm-30 wow zoomIn" data-wow-delay=".6s">--}}
{{--                        <div class="feature-box-type-2 id-color-2">--}}
{{--                            <i class="icon-upload"></i>--}}
{{--                            <h4>Cloud Powered</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md col-sm-6 mb-sm-30 wow zoomIn" data-wow-delay=".8s">--}}
{{--                        <div class="feature-box-type-2 id-color-2">--}}
{{--                            <i class="icon-layers"></i>--}}
{{--                            <h4>Multi Datacenter</h4>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        <section class="bgcolor-variation pos-top" data-bgimage="url(images/background/15.jpg) center" data-stellar-background-ratio=".2">
            <div class="text-center wow fadeInUp">
                <h2><span class="uptitle id-color-2">Testimonial</span>What They Says</h2>
                <div class="spacer-20"></div>
            </div>
            <div class="owl-carousel owl-theme wow fadeInUp" id="testimonial-carousel">
                <div class="item">
                    <div class="de_testi opt-2">
                        <blockquote>
                            <p>With Web2App, anyone can both build an engaging apps with no coding or design skills. For most small businesses like mine, it is the best solution because it allows owning an app with affordable price.
                            </p>
                            <div class="de_testi_by">
{{--                                <img alt="" class="rounded-circle" src="images/people/1.jpg"> --}}
                                <span>Samson, Akinlabi</span>
                            </div>
                        </blockquote>
                    </div>
                </div>
                <div class="item">
                    <div class="de_testi opt-2">
                        <blockquote>
                            <p>Through mobile app, I have obtained a greater number in terms of readership, downloads, and impressions. Thanks guys. Now, a larger number of readers can access my publications.</p>
                            <div class="de_testi_by">
{{--                                <img alt="" class="rounded-circle" src="images/people/2.jpg"> --}}
                                <span>Emmanuel, Promise</span>
                            </div>
                        </blockquote>
                    </div>
                </div>
                <div class="item">
                    <div class="de_testi opt-2">
                        <blockquote>
                            <p>I have never imagined creating a mobile app with no coding skills. But, yes it can actually work. Web2App is easy to use loaded with great features. All you need to do is follow few steps.</p>
                            <div class="de_testi_by">
{{--                                <img alt="" class="rounded-circle" src="images/people/3.jpg"> --}}
                                <span>Dorcas, Adewale</span>
                            </div>
                        </blockquote>
                    </div>
                </div>
                <div class="item">
                    <div class="de_testi opt-2">
                        <blockquote>
                            <p>Not only is it affordable but it turns our website into a great-looking app and helping to engage with our clients more efficiently</p>
                            <div class="de_testi_by">
{{--                                <img alt="" class="rounded-circle" src="images/people/4.jpg"> --}}
                                <span>Ayo, Thomas</span>
                            </div>
                        </blockquote>
                    </div>
                </div>
                <div class="item">
                    <div class="de_testi opt-2">
                        <blockquote>
                            <p>Great support. Thanks to the support team, they are very helpful. This company provide customers great solution, that makes them best.</p>
                            <div class="de_testi_by">
{{--                                <img alt="" class="rounded-circle" src="images/people/1.jpg"> --}}
                                <span>Femi, Tokunbo</span>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-faq">
            <div class="container">
                <div class="row">
                    <div class="col text-center wow fadeInUp">
                        <h2><span class="uptitle id-color-2">Do You Have</span>Any Questions?</h2>
                        <div class="spacer-20"></div>
                    </div>
                </div>
                <div class="row wow fadeInUp">
                    <div class="col-md-6">
                        <div class="accordion secondary">
                            <div class="accordion-section">
                                <div class="accordion-section-title" data-tab="#accordion-1">
                                    Why do I need mobile app?
                                </div>
                                <div class="accordion-section-content" id="accordion-1">
                                    <p>Mobile apps improve your conversion stream as they help customers understand your offerings better and let them connect with you instantly. Moreover, an app with unique features and beautiful design also improves user experience dramatically.</p>
                                </div>
                                <div class="accordion-section-title" data-tab="#accordion-2">
                                    Will there be increase in my traffic, customers or sales?
                                </div>
                                <div class="accordion-section-content" id="accordion-2">
                                    <p>As of November 2020, the global share for Android is 71.18%. When you build an Android app this is the sharpest edge you get. The more audience you have at your disposal, greater would be the chances of your app being a success.</p>
                                </div>
                                <div class="accordion-section-title" data-tab="#accordion-3">
                                    What do I need to get started?
                                </div>
                                <div class="accordion-section-content" id="accordion-3">
                                    <p>You only need to enter your website URL, upload your logo to convert your website into an app within minutes</p>
                                </div>
                                <div class="accordion-section-title" data-tab="#accordion-4">
                                    How will I receive my application?
                                </div>
                                <div class="accordion-section-content" id="accordion-4">
                                    <p>Your application will be delivered to you via email (to your inbox).</p>
                                </div>
                                <div class="accordion-section-title" data-tab="#accordion-5">
                                    Do you provide Push Notifications?
                                </div>
                                <div class="accordion-section-content" id="accordion-5">
                                    <p>Yes, we do provide Push Notifications for iOS and Android.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="accordion secondary">
                            <div class="accordion-section">
                                <div class="accordion-section-title" data-tab="#accordion-b-4">
                                    When will my application be ready?
                                </div>
                                <div class="accordion-section-content" id="accordion-b-4">
                                    <p>Your app will be ready in 10 minutes</p>
                                </div>
                                <div class="accordion-section-title" data-tab="#accordion-b-5">
                                    How many times do I have to pay?
                                </div>
                                <div class="accordion-section-content" id="accordion-b-5">
                                    <p>You only have to pay once to convert one website. There are no monthly or yearly fees. Yes! It is just a one time payment. You can check our pricing here.</p>
                                </div>
                                <div class="accordion-section-title" data-tab="#accordion-b-6">
                                    Can I publish the app on Google play store, App store and Microsoft store?
                                </div>
                                <div class="accordion-section-content" id="accordion-b-6">
                                    <p>Yes, perfectly well. Once you download your application, you can publish it without any problem. It is a really easy process, you will be able to publish the apps in 15 minutes . In case you need help, our team can assist you. We can also offer push to store automation as soon as your application finish building at low cost.</p>
                                </div>

                                <div class="accordion-section-title" data-tab="#accordion-b-5">
                                    How will my application look?
                                </div>
                                <div class="accordion-section-content" id="accordion-b-5">
                                    <p>Your application will look exactly as your website on mobile devices without the browser interface.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-fun-facts" class="no-top no-bottom text-light bg-color-2">
            <div class="container-fluid">

                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6" data-bgcolor="rgba(0,0,0,.1)">
                        <div class="de_count pt60 pb40">
                            <h3 class="timer" data-to="15425" data-speed="3000">0</h3>
                            <span class="id-color-2">Android Apps</span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6" data-bgcolor="rgba(0,0,0,.2)">
                        <div class="de_count pt60 pb40">
                            <h3 class="timer" data-to="8745" data-speed="3000">0</h3>
                            <span class="id-color-2">IOS Apps</span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6" data-bgcolor="rgba(0,0,0,.3)">
                        <div class="de_count pt60 pb40">
                            <h3 class="timer" data-to="235" data-speed="3000">0</h3>
                            <span class="id-color-2">Window Apps</span>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6" data-bgcolor="rgba(0,0,0,.4)">
                        <div class="de_count pt60 pb40">
                            <h3 class="timer" data-to="15" data-speed="3000">0</h3>
                            <span class="id-color-2">Linux Apps</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>
@endsection
