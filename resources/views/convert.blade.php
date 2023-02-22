@extends('include.layouts')

@section('content')
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- revolution slider begin -->
        <!-- section begin -->

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @if (session('status'))
            <script>
                swal("{{ session('status') }}");
            </script>
        @endif


        @if ($errors->any())
            <div class="alert-danger alert">
                <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}
                </div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action='{{ route('submitconvert') }}' id='form_sb' method="post" name="myForm" enctype="multipart/form-data">
            @csrf
            <section class="relative no-top no-bottom text-light" data-bgimage="url(images/background/6.jpg)"
                data-stellar-background-ratio=".2">

                <div class="overlay-gradient t80">
                    <div class="center-y relative text-center" data-scroll-speed="4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="col text-center">
                                        <div class="spacer-single"></div>
                                        <h1>Convert Now</h1>
                                        <p class="lead">It is easy, just enter your website url, you can manage other
                                            settings below.<br />All Payments are paid once</p>

                                        <div class="spacer-single"></div>


                                        <div class="col text-center">
                                            <div class="spacer-10"></div>
                                            <input class="form-control form-control-lg" id='appname' name='appname'
                                                placeholder="App Name" type='text1' required>
                                            <div class="clearfix"></div>
                                            <div class="spacer-30"></div>
                                            <input class="form-control form-control-lg" id='url' name='url'
                                                placeholder="Website URL" type='url' required>
                                            <div class="clearfix"></div>
                                            <div class="spacer-30"></div>
                                            <input class="form-control form-control-lg" id='email' name='email'
                                                   placeholder="E-mail Address" type='email' required>
                                            <div class="spacer-20"></div>

                                            <div class="box-highlight">
                                                <div onclick="hideunhide('general')" class="heading text-center text-white">
                                                    <h3>General (Optional) <i class="fa fa-arrow-circle-o-down"></i></h3>
                                                </div>
                                                <div id="general" class="content" style="display: none">
                                                    <div class="accordion">
                                                        <div class="accordion-section">
                                                            <div class="accordion-section-title" data-tab="#accordion-2">
                                                                Logo
                                                            </div>
                                                            <div class="accordion-section-content" id="accordion-2">
                                                                <p>Select your app icon (Recommended PNG format,512px by 512px)</p>
                                                                <input class="form-control" name='icon'
                                                                       placeholder="Paste image link" type='text1'>
                                                            </div>
                                                            <div class="accordion-section-title" data-tab="#accordion-3">
                                                                Full Screen
                                                            </div>
                                                            <div class="accordion-section-content" id="accordion-3">
                                                                <p>Selecting true means you want to disregard bottom navigation and header
                                                                </p>
                                                                <select name="fullscreen" class="form-control">
                                                                    <option>No</option>
                                                                    <option>Yes</option>
                                                                </select>
                                                            </div>
                                                            <div class="accordion-section-title" data-tab="#accordion-4">
                                                                Primary Color
                                                            </div>
                                                            <div class="accordion-section-content" id="accordion-4">
                                                                <p>Choose your color</p>
                                                                <input class="form-control" name='primarycolor'
                                                                       placeholder="Type your app name" type='color'>
                                                            </div>

                                                            <div class="accordion-section-title" data-tab="#accordion-5">
                                                                Package Name
                                                            </div>
                                                            <div class="accordion-section-content" id="accordion-5">
                                                                <p>The package name to be identified with on store</p>
                                                                <input class="form-control" name='packagename'
                                                                       placeholder="e.g com.appname" type='text1'>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="spacer-20"></div>
                                            <div class="box-highlight s2">
                                                <div onclick="hideunhide('advance')" class="heading text-center text-white">
                                                    <h3>Advanced Settings (Optional) <i class="fa fa-arrow-circle-o-down"></i></h3>
                                                </div>
                                                <div id="advance" class="content" style="display: none">

                                                    <div class="accordion">
                                                        <div class="accordion-section">

                                                            <div class="accordion-section-title" data-tab="#accordion-b-0">
                                                                Publish to Store
                                                            </div>
                                                            <div class="accordion-section-content" id="accordion-b-0">
                                                                <select name="publish" class="form-control">
                                                                    <option value="no" selected>No</option>
                                                                    <option value="yes">Yes</option>
                                                                </select>
                                                            </div>

                                                            <div class="accordion-section-title" data-tab="#accordion-b-1">
                                                                Firebase (google-services.json)
                                                            </div>
                                                            <div class="accordion-section-content" id="accordion-b-1">
                                                                <input type="file" name="firebase" class="form-control-file"/>
                                                            </div>

                                                            <div class="accordion-section-title" data-tab="#accordion-b-2">
                                                                Dynamic Link
                                                            </div>
                                                            <div class="accordion-section-content" id="accordion-b-2">
                                                                <p>Kindly enter the Uri Prefix then followed by Link Prefix</p>
                                                                <input class="form-control" name='uriPrefix' placeholder="e.g https://web2app.page.link" type='url'>
                                                                <input class="form-control" name='linkPrefix' placeholder="e.g https://web2app.app/link" type='url'>
                                                            </div>

                                                            <div class="accordion-section-title" data-tab="#accordion-b-3">
                                                                Admob
                                                            </div>
                                                            <div class="accordion-section-content" id="accordion-b-3">
                                                                <p>Selecting yes means you want to monetize your app</p>
                                                                <select name="admob" class="form-control">
                                                                    <option>No</option>
                                                                    <option>Yes</option>
                                                                </select>
                                                                <input class="form-control" name='admobID' placeholder="Admob ID"
                                                                       type='text'>
                                                            </div>


                                                            <div class="accordion-section-title" data-tab="#accordion-b-4">
                                                                Bottom Navigation
                                                            </div>
                                                            <div class="accordion-section-content" id="accordion-b-4">
                                                                <p class="mb-5"> Nav 1
                                                                    <select name="tabIcon[]" class="form-control">
                                                                        <option value="Icons.home">Home Icon</option>
                                                                        <option value="Icons.history">History Icon</option>
                                                                        <option value="Icons.account_balance_wallet">Wallet Icon</option>
                                                                        <option value="Icons.add">Add Icon</option>
                                                                        <option value="Icons.search">Search Icon</option>
                                                                        <option value="Icons.security">Security Icon</option>
                                                                        <option value="Icons.access_time">Clock Icon</option>
                                                                        <option value="Icons.add_alert_rounded">Notification Icon</option>
                                                                        <option value="Icons.account_balance_rounded">Bank Icon</option>
                                                                        <option value="Icons.contact_mail">Contact Icon</option>
                                                                        <option value="Icons.add_shopping_cart">Shopping Cart Icon</option>
                                                                        <option value="Icons.help">Help Icon</option>
                                                                        <option value="Icons.settings">Settings Icon</option>
                                                                        <option value="Icons.headphones">Headphone Icon</option>
                                                                        <option value="Icons.key">Key Icon</option>
                                                                    </select>
                                                                    <input class="form-control" name='tabName[]' placeholder="Enter Tab Name"
                                                                           type='text1'>
                                                                    <input class="form-control" name='tabLink[]' placeholder="Enter Tab Link"
                                                                           type='text1'>
                                                                </p>

                                                                <p class="mb-5"> Nav 2
                                                                    <select name="tabIcon[]" class="form-control">
                                                                        <option value="Icons.home">Home Icon</option>
                                                                        <option value="Icons.history">History Icon</option>
                                                                        <option value="Icons.account_balance_wallet">Wallet Icon</option>
                                                                        <option value="Icons.add">Add Icon</option>
                                                                        <option value="Icons.search">Search Icon</option>
                                                                        <option value="Icons.security">Security Icon</option>
                                                                        <option value="Icons.access_time">Clock Icon</option>
                                                                        <option value="Icons.add_alert_rounded">Notification Icon</option>
                                                                        <option value="Icons.account_balance_rounded">Bank Icon</option>
                                                                        <option value="Icons.contact_mail">Contact Icon</option>
                                                                        <option value="Icons.add_shopping_cart">Shopping Cart Icon</option>
                                                                        <option value="Icons.help">Help Icon</option>
                                                                        <option value="Icons.settings">Settings Icon</option>
                                                                        <option value="Icons.headphones">Headphone Icon</option>
                                                                        <option value="Icons.key">Key Icon</option>
                                                                    </select>
                                                                    <input class="form-control" name='tabName[]' placeholder="Enter Tab Name"
                                                                           type='text1'>
                                                                    <input class="form-control" name='tabLink[]' placeholder="Enter Tab Link"
                                                                           type='text1'>
                                                                </p>

                                                                <p class="mb-5"> Nav 3
                                                                    <select name="tabIcon[]" class="form-control">
                                                                        <option value="Icons.home">Home Icon</option>
                                                                        <option value="Icons.history">History Icon</option>
                                                                        <option value="Icons.account_balance_wallet">Wallet Icon</option>
                                                                        <option value="Icons.add">Add Icon</option>
                                                                        <option value="Icons.search">Search Icon</option>
                                                                        <option value="Icons.security">Security Icon</option>
                                                                        <option value="Icons.access_time">Clock Icon</option>
                                                                        <option value="Icons.add_alert_rounded">Notification Icon</option>
                                                                        <option value="Icons.account_balance_rounded">Bank Icon</option>
                                                                        <option value="Icons.contact_mail">Contact Icon</option>
                                                                        <option value="Icons.add_shopping_cart">Shopping Cart Icon</option>
                                                                        <option value="Icons.help">Help Icon</option>
                                                                        <option value="Icons.settings">Settings Icon</option>
                                                                        <option value="Icons.headphones">Headphone Icon</option>
                                                                        <option value="Icons.key">Key Icon</option>
                                                                    </select>
                                                                    <input class="form-control" name='tabName[]' placeholder="Enter Tab Name"
                                                                           type='text1'>
                                                                    <input class="form-control" name='tabLink[]' placeholder="Enter Tab Link"
                                                                           type='text1'>
                                                                </p>

                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="spacer-20"></div>

                                            <div class="domain-ext">
                                                <div class="ext">
                                                    <h4>Basic Plan</h4>
                                                    ₦5,000
                                                    <input name="plan" type="radio" id="radio_30"
                                                        class="with-gap radio-col-primary" value="basic" checked="">
                                                </div>

                                                <div class="ext">
                                                    <h4>Gold Plan</h4>
                                                    ₦10,000
                                                    <input name="plan" type="radio" id="radio_32"
                                                        class="with-gap radio-col-success" value="gold">
                                                </div>

                                                <div class="ext">
                                                    <h4>Premium Plan</h4>
                                                    ₦20,000
                                                    <input name="plan" type="radio" id="radio_33"
                                                        class="with-gap radio-col-info" value="premium">
                                                </div>

                                                <div class="ext">
                                                    <h4>Free trial</h4>
                                                    ₦0
                                                    <input name="plan" type="radio" id="radio_35"
                                                        class="with-gap radio-col-warning" value="free">
                                                </div>
                                            </div>

                                            <div class="spacer-20"></div>

                                            <button type="submit" id="btn-submit" class="btn btn-primary btn-group-lg btn-lg">Convert Now</button>
                                            <br />
                                            <span class="text-center" style="font-size: 10px"> <i class="fa fa-arrow-circle-o-down"> </i> Do more below</span>

                                        </div>

                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- section close -->


{{--            <section id="section-features">--}}
{{--                <div class="container">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6 mb30">--}}
{{--                            <div class="box-highlight">--}}
{{--                                <div class="heading text-center text-white">--}}
{{--                                    <h3>General</h3>--}}
{{--                                </div>--}}
{{--                                <div class="content">--}}

{{--                                    <div class="accordion">--}}
{{--                                        <div class="accordion-section">--}}
{{--                                            <div class="accordion-section-title" data-tab="#accordion-2">--}}
{{--                                                Logo--}}
{{--                                            </div>--}}
{{--                                            <div class="accordion-section-content" id="accordion-2">--}}
{{--                                                <p>Select your app icon (Recommended PNG format,512px by 512px)</p>--}}
{{--                                                <input class="form-control" name='icon'--}}
{{--                                                       placeholder="Paste image link" type='text1'>--}}
{{--                                            </div>--}}
{{--                                            <div class="accordion-section-title" data-tab="#accordion-3">--}}
{{--                                                Full Screen--}}
{{--                                            </div>--}}
{{--                                            <div class="accordion-section-content" id="accordion-3">--}}
{{--                                                <p>Selecting true means you want to disregard bottom navigation and header--}}
{{--                                                </p>--}}
{{--                                                <select name="fullscreen" class="form-control">--}}
{{--                                                    <option>No</option>--}}
{{--                                                    <option>Yes</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                            <div class="accordion-section-title" data-tab="#accordion-4">--}}
{{--                                                Primary Color--}}
{{--                                            </div>--}}
{{--                                            <div class="accordion-section-content" id="accordion-4">--}}
{{--                                                <p>Choose your color</p>--}}
{{--                                                <input class="form-control" name='primarycolor'--}}
{{--                                                    placeholder="Type your app name" type='color'>--}}
{{--                                            </div>--}}

{{--                                            <div class="accordion-section-title" data-tab="#accordion-5">--}}
{{--                                                Package Name--}}
{{--                                            </div>--}}
{{--                                            <div class="accordion-section-content" id="accordion-5">--}}
{{--                                                <p>The package name to be identified with on store</p>--}}
{{--                                                <input class="form-control" name='packagename'--}}
{{--                                                       placeholder="e.g com.appname" type='text1'>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-md-6 mb30">--}}
{{--                            <div class="box-highlight s2">--}}
{{--                                <div class="heading text-center text-white">--}}
{{--                                    <h3>Advanced Settings</h3>--}}
{{--                                </div>--}}
{{--                                <div class="content">--}}

{{--                                    <div class="accordion">--}}
{{--                                        <div class="accordion-section">--}}
{{--                                            <div class="accordion-section-title" data-tab="#accordion-b-0">--}}
{{--                                                Publish to Store--}}
{{--                                            </div>--}}
{{--                                            <div class="accordion-section-content" id="accordion-b-0">--}}
{{--                                                <select name="publish" class="form-control">--}}
{{--                                                    <option value="no" selected>No</option>--}}
{{--                                                    <option value="yes">Yes</option>--}}
{{--                                                </select>--}}
{{--                                            </div>--}}

{{--                                            <div class="accordion-section-title" data-tab="#accordion-b-3">--}}
{{--                                                Admob--}}
{{--                                            </div>--}}
{{--                                            <div class="accordion-section-content" id="accordion-b-3">--}}
{{--                                                <p>Selecting yes means you want to monetize your app</p>--}}
{{--                                                <select name="admob" class="form-control">--}}
{{--                                                    <option>No</option>--}}
{{--                                                    <option>Yes</option>--}}
{{--                                                </select>--}}
{{--                                                <input class="form-control" name='admobID' placeholder="Admob ID"--}}
{{--                                                    type='text'>--}}
{{--                                            </div>--}}


{{--                                            <div class="accordion-section-title" data-tab="#accordion-b-4">--}}
{{--                                                Bottom Navigation--}}
{{--                                            </div>--}}
{{--                                            <div class="accordion-section-content" id="accordion-b-4">--}}
{{--                                                <p class="mb-5"> Nav 1--}}
{{--                                                    <select name="tabIcon[]" class="form-control">--}}
{{--                                                        <option value="Icons.home">Home Icon</option>--}}
{{--                                                        <option value="Icons.history">History Icon</option>--}}
{{--                                                        <option value="Icons.account_balance_wallet">Wallet Icon</option>--}}
{{--                                                        <option value="Icons.add">Add Icon</option>--}}
{{--                                                        <option value="Icons.search">Search Icon</option>--}}
{{--                                                        <option value="Icons.security">Security Icon</option>--}}
{{--                                                        <option value="Icons.access_time">Clock Icon</option>--}}
{{--                                                        <option value="Icons.add_alert_rounded">Notification Icon</option>--}}
{{--                                                        <option value="Icons.account_balance_rounded">Bank Icon</option>--}}
{{--                                                        <option value="Icons.contact_mail">Contact Icon</option>--}}
{{--                                                        <option value="Icons.add_shopping_cart">Shopping Cart Icon</option>--}}
{{--                                                        <option value="Icons.help">Help Icon</option>--}}
{{--                                                        <option value="Icons.settings">Settings Icon</option>--}}
{{--                                                        <option value="Icons.headphones">Headphone Icon</option>--}}
{{--                                                        <option value="Icons.key">Key Icon</option>--}}
{{--                                                    </select>--}}
{{--                                                    <input class="form-control" name='tabName[]' placeholder="Enter Tab Name"--}}
{{--                                                           type='text1'>--}}
{{--                                                    <input class="form-control" name='tabLink[]' placeholder="Enter Tab Link"--}}
{{--                                                             type='text1'>--}}
{{--                                                </p>--}}

{{--                                                <p class="mb-5"> Nav 2--}}
{{--                                                    <select name="tabIcon[]" class="form-control">--}}
{{--                                                        <option value="Icons.home">Home Icon</option>--}}
{{--                                                        <option value="Icons.history">History Icon</option>--}}
{{--                                                        <option value="Icons.account_balance_wallet">Wallet Icon</option>--}}
{{--                                                        <option value="Icons.add">Add Icon</option>--}}
{{--                                                        <option value="Icons.search">Search Icon</option>--}}
{{--                                                        <option value="Icons.security">Security Icon</option>--}}
{{--                                                        <option value="Icons.access_time">Clock Icon</option>--}}
{{--                                                        <option value="Icons.add_alert_rounded">Notification Icon</option>--}}
{{--                                                        <option value="Icons.account_balance_rounded">Bank Icon</option>--}}
{{--                                                        <option value="Icons.contact_mail">Contact Icon</option>--}}
{{--                                                        <option value="Icons.add_shopping_cart">Shopping Cart Icon</option>--}}
{{--                                                        <option value="Icons.help">Help Icon</option>--}}
{{--                                                        <option value="Icons.settings">Settings Icon</option>--}}
{{--                                                        <option value="Icons.headphones">Headphone Icon</option>--}}
{{--                                                        <option value="Icons.key">Key Icon</option>--}}
{{--                                                    </select>--}}
{{--                                                    <input class="form-control" name='tabName[]' placeholder="Enter Tab Name"--}}
{{--                                                           type='text1'>--}}
{{--                                                    <input class="form-control" name='tabLink[]' placeholder="Enter Tab Link"--}}
{{--                                                             type='text1'>--}}
{{--                                                </p>--}}

{{--                                                <p class="mb-5"> Nav 3--}}
{{--                                                    <select name="tabIcon[]" class="form-control">--}}
{{--                                                        <option value="Icons.home">Home Icon</option>--}}
{{--                                                        <option value="Icons.history">History Icon</option>--}}
{{--                                                        <option value="Icons.account_balance_wallet">Wallet Icon</option>--}}
{{--                                                        <option value="Icons.add">Add Icon</option>--}}
{{--                                                        <option value="Icons.search">Search Icon</option>--}}
{{--                                                        <option value="Icons.security">Security Icon</option>--}}
{{--                                                        <option value="Icons.access_time">Clock Icon</option>--}}
{{--                                                        <option value="Icons.add_alert_rounded">Notification Icon</option>--}}
{{--                                                        <option value="Icons.account_balance_rounded">Bank Icon</option>--}}
{{--                                                        <option value="Icons.contact_mail">Contact Icon</option>--}}
{{--                                                        <option value="Icons.add_shopping_cart">Shopping Cart Icon</option>--}}
{{--                                                        <option value="Icons.help">Help Icon</option>--}}
{{--                                                        <option value="Icons.settings">Settings Icon</option>--}}
{{--                                                        <option value="Icons.headphones">Headphone Icon</option>--}}
{{--                                                        <option value="Icons.key">Key Icon</option>--}}
{{--                                                    </select>--}}
{{--                                                    <input class="form-control" name='tabName[]' placeholder="Enter Tab Name"--}}
{{--                                                           type='text1'>--}}
{{--                                                    <input class="form-control" name='tabLink[]' placeholder="Enter Tab Link"--}}
{{--                                                             type='text1'>--}}
{{--                                                </p>--}}

{{--                                            </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="col-md-6 mb30">--}}
{{--                            <div class="box-highlight s2">--}}
{{--                                <div class="heading text-center text-white">--}}
{{--                                    <h3>About</h3>--}}
{{--                                </div>--}}
{{--                                <div class="content">--}}

{{--                                    <div class="accordion">--}}
{{--                                        <div class="accordion-section">--}}
{{--                                            <div class="accordion-section-title" data-tab="#accordion-ab-1">--}}
{{--                                                About Us--}}
{{--                                            </div>--}}


{{--                                            <div class="accordion-section-content" id="accordion-ab-1">--}}
{{--                                                <p>The package name to be identified with on store</p>--}}
{{--                                                <input class="form-control" name='packagename'--}}
{{--                                                       placeholder="e.g com.appname" type='text1'>--}}
{{--                                            </div>--}}



{{--                                            <div class="accordion-section-title" data-tab="#accordion-ab-2">--}}
{{--                                              Privacy and Policy--}}
{{--                                            </div>--}}


{{--                                            <div class="accordion-section-content" id="accordion-ab-2">--}}
{{--                                                <p>The package name to be identified with on store</p>--}}
{{--                                                <input class="form-control" name='packagename'--}}
{{--                                                       placeholder="e.g com.appname" type='text1'>--}}
{{--                                            </div>--}}


{{--                                            <div class="accordion-section-title" data-tab="#accordion-ab-3">--}}
{{--                                              Terms and Conditions--}}
{{--                                            </div>--}}


{{--                                            <div class="accordion-section-content" id="accordion-ab-3">--}}
{{--                                                <p>The package name to be identified with on store</p>--}}
{{--                                                <input class="form-control" name='packagename'--}}
{{--                                                       placeholder="e.g com.appname" type='text1'>--}}
{{--                                            </div>--}}



{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}
        </form>

    </div>
    <!-- content close -->

    <script>
        function hideunhide(name) {
            console.log(name);
            var general = document.getElementById(name);

            if (general.style.display == "block") {
                general.style.display = 'none';
            } else {
                general.style.display = 'block';
            }
        }
    </script>

@endsection
