@extends('include.layouts')

@section('content')

    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section class="no-top no-bottom text-light" data-bgimage="url(images/background/11.jpg)" data-stellar-background-ratio=".2">

            <div class="overlay-gradient t90">
                <div class="container">
                    <div class="row">
{{--                        <div class="col-md-12 text-center">--}}
{{--                            <div class="spacer-50 sm-hide"></div>--}}
{{--                            <h1 class="no-bottom">Your request is successful</h1>--}}
{{--                            <p class="lead">Reserve your domain today before someone take it.</p>--}}
{{--                        </div>--}}

                        <div class="spacer-60"></div>

                        <div class="col-md-8 offset-md-2">

                            <div class="box-highlight s2 text-center mb40">
                                <div class="heading"><h3>Hurray!!!</h3></div>
                                <div class="content v1">
                                    <p>Hurray, we have received your conversion request and it is currently being handled by our system, you will receive email as soon as the app is ready. Below is your Reference Code</p>
                                    <div class="spacer-10"></div>
                                    <strong>{{$reference}}</strong>
                                    <div class="spacer-30"></div>
                                    <a href="{{route('convert')}}" class="btn-custom mt-5">Convert Another Website</a>
                                    <div class="spacer-10"></div>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>
            </div>

        </section>
        <!-- section close -->


    </div>

@endsection
