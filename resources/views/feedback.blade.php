@extends('include.layouts')

@section('content')
    <div class="no-bottom no-top" id="content">
        <div class="container" style="margin-top:200px;">
            <div class="row">
@if(session()->has('status'))
<div class="alert alert-success">
{{ session()->get('status') }}
</div>
@endif

                <div class="card">
                    <div class="card-header bg-primary" style="width:150px;">
                        <h6>Give us Feedback</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('feedback') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Feedback</label>
                                    <textarea name="feedback" id="" class="form-control"></textarea>
                                    
                                </div>
                                <button type="submit" class="btn btn-success form-control mt-3">Save</button>

                            </div>


                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
