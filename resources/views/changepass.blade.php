@extends('include.layouts')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top:150px; margin-bottom:50px;">
                <div class="container">
                    @if (session()->has('status'))
                        <div class="alert alert-success">
                            {{ session()->get('status') }}
                        </div>
                    @elseif (session()->has('error'))
                       <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>

                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="name@example.com" required>
                                    </div> --}}
                                <div class="mb-3">
                                    <label for="new password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="old_pass" placeholder="Old Password"
                                        required>
                                    @error('old_pass')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="new_pass" placeholder="New Password"
                                        required>
                                    @error('new_pass')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="cornfirm pass" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" name="confirm_pass"
                                        placeholder="Confirm New Password" required>
                                    @error('confirm_pass')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
