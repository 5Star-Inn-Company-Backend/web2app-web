@extends('include.layouts')

@section('content')
    <!-- content begin -->
    <div id="content" class="no-top no-bottom">

        <section class="no-top no-bottom text-light" data-bgimage="url(images/background/12.jpg)" data-stellar-background-ratio=".2">
            <div class="overlay-gradient t80">
                <div class="center-y mt50">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-12 text-lg-left text-center mb-sm-30">
                                <h1>Our Pricing<span class="label">5% OFF</span></h1>
                                <p class="lead">We provide best software solutions for your needs with affordable price. Dear client enjoy 5% discount now, you are only paying once and then you have your app for lifetime. Catch the attention of your customers now!
                                </p>
                                <div class="spacer-half"></div>
                                <a class="btn-custom" href="#plans">See All Plans</a>
                            </div>

                            <div class="col-lg-3 offset-lg-2 col-4 offset-4 text-center">
                                <img src="images/big-icon-shared-hosting.png" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="plans">
            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <h2>Affordable Price</h2>
{{--                        <div class="switch-set">--}}
{{--                            <div>Monthly</div>--}}
{{--                            <div><input id="sw-1" class="switch" type="checkbox" /></div>--}}
{{--                            <div>Yearly</div>--}}
{{--                            <div class="spacer-20"></div>--}}
{{--                        </div>--}}

                    </div>
                </div>
                <div class="item pricing">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="pricing-s1 mb30">
                                    <div class="top">
                                        <h2>Basic Plan</h2>
                                        <p class="price">
{{--                                            <span class="txt">Start from</span>--}}
                                            <span class="currency">₦</span>
                                            <span class="m opt-1">5,000</span>
                                            <span class="y opt-2">5,000</span>
                                            <span class="month">$10</span>
                                        </p>
                                    </div>

                                    <div class="bottom">

                                        <ul>
                                            <li><i class="fa fa-check-square"></i>Android App</li>
                                            <li><i class="fa fa-check-square"></i>App Icon</li>
                                            <li><i class="fa fa-check-square"></i>Splash Screen</li>
                                            <li><i class="fa fa-check-square"></i>App Monetization</li>
                                            <li><i class="fa fa-check-square"></i>Push Notification</li>
                                            <li><i class="fa fa-check-square"></i>Priority Support</li>
                                            <li><i class="fa fa-check-square"></i>Ownership & Certification</li>
                                            <li><i class="fa fa-check-square"></i>Sharable APK</li>
                                        </ul>
                                    </div>

                                    <div class="action">
                                        <a href="{{route('convert')}}" class="btn-custom">Convert Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="pricing-s1 mb30">
                                    <div class="top">
                                        <h2>Gold Plan</h2>
                                        <p class="price">
{{--                                            <span class="txt">Start from</span>--}}
                                            <span class="currency">₦</span>
                                            <span class="m opt-1">10,000</span>
                                            <span class="y opt-2">10,000</span>
                                            <span class="month">$20</span>
                                        </p>
                                    </div>
                                    <div class="bottom">
                                        <ul>
                                            <li><i class="fa fa-check-square"></i>Android App</li>
                                            <li><i class="fa fa-check-square"></i>App Bundle (AAB)</li>
{{--                                            <li><i class="fa fa-check-square"></i>Window App</li>--}}
                                            <li><i class="fa fa-check-square"></i>App Icon</li>
                                            <li><i class="fa fa-check-square"></i>Splash Screen</li>
                                            <li><i class="fa fa-check-square"></i>App Monetization</li>
                                            <li><i class="fa fa-check-square"></i>Push Notification</li>
                                            <li><i class="fa fa-check-square"></i>Priority Support</li>
                                            <li><i class="fa fa-check-square"></i>Ownership & Certification</li>
                                            <li><i class="fa fa-check-square"></i>Publishable to Store</li>
                                        </ul>
                                    </div>

                                    <div class="action">
                                        <a href="{{route('convert')}}" class="btn-custom">Convert Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="pricing-s1 mb30">
                                    <div class="top">
                                        <h2>Premium Plan</h2>
                                        <p class="price">
{{--                                            <span class="txt">Start from</span>--}}
                                            <span class="currency">₦</span>
                                            <span class="m opt-1">20,000</span>
                                            <span class="y opt-2">20,000</span>
                                            <span class="month">$40</span>
                                        </p>
                                    </div>
                                    <div class="bottom">
                                        <ul>
                                            <li><i class="fa fa-check-square"></i>IOS App</li>
                                            <li><i class="fa fa-check-square"></i>Android App</li>
                                            <li><i class="fa fa-check-square"></i>App Bundle (AAB)</li>
{{--                                            <li><i class="fa fa-check-square"></i>Window App</li>--}}
                                            <li><i class="fa fa-check-square"></i>App Icon</li>
                                            <li><i class="fa fa-check-square"></i>Splash Screen</li>
                                            <li><i class="fa fa-check-square"></i>App Monetization</li>
                                            <li><i class="fa fa-check-square"></i>Push Notification</li>
                                            <li><i class="fa fa-check-square"></i>Priority Support</li>
                                            <li><i class="fa fa-check-square"></i>Ownership & Certification</li>
                                            <li><i class="fa fa-check-square"></i>Publishable to Store</li>
                                        </ul>
                                    </div>

                                    <div class="action">
                                        <a href="{{route('convert')}}" class="btn-custom">Convert Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

{{--        <section id="section-faq">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col text-center">--}}
{{--                        <h2>General Questions</h2>--}}
{{--                        <div class="spacer-20"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-10 offset-md-1">--}}
{{--                        <div class="accordion">--}}
{{--                            <div class="accordion-section">--}}
{{--                                <div class="accordion-section-title" data-tab="#accordion-1">--}}
{{--                                    How do I get started with web hosting?--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-content" id="accordion-1">--}}
{{--                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique--}}
{{--                                        sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-title" data-tab="#accordion-2">--}}
{{--                                    What is difference for each plan?--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-content" id="accordion-2">--}}
{{--                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique--}}
{{--                                        sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-title" data-tab="#accordion-3">--}}
{{--                                    What kind of web hosting do I need?--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-content" id="accordion-3">--}}
{{--                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique--}}
{{--                                        sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-title" data-tab="#accordion-4">--}}
{{--                                    Why do I need domain name?--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-content" id="accordion-4">--}}
{{--                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique--}}
{{--                                        sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-title" data-tab="#accordion-5">--}}
{{--                                    What my website protected from hackers?--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-content" id="accordion-5">--}}
{{--                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique--}}
{{--                                        sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-title" data-tab="#accordion-6">--}}
{{--                                    How do I backup my website?--}}
{{--                                </div>--}}
{{--                                <div class="accordion-section-content" id="accordion-6">--}}
{{--                                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique--}}
{{--                                        sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
    </div>
    <!-- content close -->
@endsection
