@extends('include.layouts')

@section('content')
    <div class="no-bottom no-top" id="content">
        <div class="container" style="margin-top:200px;">
            <div class="row">
                <div class="card">
                    <div class="card-header bg-info">
                        <h6>Add to Store</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('submitstore') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>

                                <div class="col-md-6">
                                    <label for="">price</label>
                                    <input type="text" class="form-control" name="price" placeholder="Price">
                                </div>

                                <div class="col-md-6">
                                    <label for="">description</label>
                                    <textarea name="description" class="form-control mb-5" placeholder="Description"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Features</label>
                                    <textarea name="feature" class="form-control mb-5" placeholder="Add Features"></textarea>
                                </div>

                                <div class="col-md-6">
                                    {{-- <label for="">Image</label> --}}
                                    <input type="file" class="form-control mt-3" name="image">
                                </div>
                                <button type="submit" class="btn btn-secondary form-control mt-3">Save</button>

                            </div>


                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
