@extends('include.layouts')

@section('content')
    <div class="py-5">
        <div class="container" style="margin-top:200px">
            <div class="row">
                <strong>
                    {{-- <h2 class="mb-3">{{ $store->name }}</h2> --}}
                </strong>
                @foreach ($store as $stores)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{ asset('images/' . $stores->image) }}" alt="App Image" style="height: 500px;">
                            <div class="card-body">
                                <strong>
                                    <h5 class="text-dark">Name: {{ $stores->name }}</h5>
                                    <h5 class="text-dark float-end"> <s>N</s> {{ $stores->price }}</h5>
                                </strong>
                                <span class="float-start text-dark">Desc: {{ $stores->description }}</span>

                            </div>

                        </div>
                    </div>



                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">

                                <strong>
                                    <h2 class="float-end text-dark"> Features </h2>

                                </strong>
                                <span class="float-end text-dark" style="margin-top:50px;"> {{ $stores->feature }}</span>
                                <form action="{{ url('purchase') }}" method="post">
                                @csrf
                                        <input type="hidden" name="id" value="{{ $stores->id }}">
                                Email: <input type="email" name="email">
                                    <button type="submit" class="float-start btn btn-primary">Purchase</button>
                                </form>
                            </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
