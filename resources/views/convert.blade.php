@extends('include.layouts')

@section('content')
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- revolution slider begin -->
        <!-- section begin -->
        <section class="relative no-top no-bottom text-light" data-bgimage="url(images/background/6.jpg)" data-stellar-background-ratio=".2">

            <div class="overlay-gradient t80">
                <div class="center-y relative text-center" data-scroll-speed="4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="col text-center">
                                    <div class="spacer-single"></div>
                                    <h1>Convert Now</h1>
                                    <p class="lead">It is easy, just enter your website url, you can manage other settings below.</p>

                                    <div class="spacer-single"></div>

                                    <form action='https://www.designesia.com/themes/uhost/blank.php' class="row" id='form_sb' method="post" name="myForm">
                                        <div class="col text-center">
                                            <div class="spacer-10"></div>
                                            <input class="form-control" id='name_1' name='name_1' placeholder="Type your website url here" type='text'> <a href="search-results.html" id="btn-submit"><i class="arrow_right"></i></a>
                                            <div class="clearfix"></div>
                                            <div class="spacer-10"></div>
                                            <div class="domain-ext">
                                                <div class="ext">
                                                    <h4>Android</h4>
                                                    $50
                                                </div>

                                                <div class="ext">
                                                    <h4>IOS</h4>
                                                    $3.99/year
                                                </div>

                                                <div class="ext">
                                                    <h4>Window</h4>
                                                    $2.99/year
                                                </div>

                                                <div class="ext">
                                                    <h4>Linux</h4>
                                                    $3.90/year
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- section close -->


        <section id="section-features">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb30">
                        <div class="box-highlight">
                            <div class="heading text-center text-white"><h3>General</h3></div>
                            <div class="content">

                                <div class="accordion">
                                    <div class="accordion-section">
                                        <div class="accordion-section-title" data-tab="#accordion-1">
                                            App Name
                                        </div>
                                        <div class="accordion-section-content" id="accordion-1">
                                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                                        </div>
                                        <div class="accordion-section-title" data-tab="#accordion-2">
                                            Logo
                                        </div>
                                        <div class="accordion-section-content" id="accordion-2">
                                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                                        </div>
                                        <div class="accordion-section-title" data-tab="#accordion-3">
                                            Full Screen
                                        </div>
                                        <div class="accordion-section-content" id="accordion-3">
                                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                                        </div>
                                        <div class="accordion-section-title" data-tab="#accordion-4">
                                            Primary Color
                                        </div>
                                        <div class="accordion-section-content" id="accordion-4">
                                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb30">
                        <div class="box-highlight s2">
                            <div class="heading text-center text-white"><h3>Advanced Settings</h3></div>
                            <div class="content">

                                <div class="accordion">
                                    <div class="accordion-section">
                                        <div class="accordion-section-title" data-tab="#accordion-b-1">
                                            Bottom Navigation
                                        </div>
                                        <div class="accordion-section-content" id="accordion-b-1">
                                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                                        </div>
                                        <div class="accordion-section-title" data-tab="#accordion-b-2">
                                            Admob
                                        </div>
                                        <div class="accordion-section-content" id="accordion-b-2">
                                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>
    <!-- content close -->

@endsection
