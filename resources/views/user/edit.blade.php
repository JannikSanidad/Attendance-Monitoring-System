@extends('layouts.app')

@section('title')Show User @endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6 centered">
            <div class="card vertical-centered">
                <div class="card-header bg-light"><h1 class="title text-center">Edit account</h1></div>
                <div class="card-body">
                    @include('include.messages')
                    <form action="/users/{{ $user->admin_id }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input class="form-control" type="text" name="username" required value="{{ $user->username }}">
                            </div>

                            <div class="form-group">
                                <label for="">New Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Enter Password">
                            </div>

                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input class="form-control" type="password" name="confirmPassword" placeholder="Enter Password">
                            </div>

                            <div class="form-group">
                                <label for="">First Name</label>
                                <input class="form-control" type="text" name="firstname" required value="{{ $user->first_name }}">
                            </div>

                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input class="form-control" type="text" name="lastname" required value="{{ $user->last_name }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control btn bg-green" type="submit" name="login" value="Update">
                            </div>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection