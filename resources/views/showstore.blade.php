@extends('include.layouts')

@section('content')
     <div class="py-5">
        <div class="container" style="margin-top:200px">
            <div class="row">
                {{-- <div class="col-md-12"> --}}
                <h1>Available Apps</h1>
                @foreach ($store as $stores)
                    <div class="col-md-4">
                        <a href="{{ url('viewstore/' . $stores->id) }}" class="text-decoration-none">
                            <div class="card mb-5">
                                <img src="{{ asset('images/' . $stores->image) }}" alt="App Image"
                                    style="height: 500px;">
                                <div class="card-body">
                                    <h5 class="text-black">{{ $stores->name }}</h5>
                                    <span class="float-end text-black">Price:    {{ $stores->price }}</span>
                                    <p class="float-start text-black">{{ $stores->description }}</p>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
