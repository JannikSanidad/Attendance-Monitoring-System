@extends('layouts.app')

@section('title')Create User @endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6 centered">
            <div class="card vertical-centered">
                <div class="card-header bg-light"><h1 class="title text-center">Register a new admin</h1></div>
                <div class="card-body">
                    @include('include.messages')
                    <!-- RECORD FILL UP FORM -->
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="admin_id">ID Number</label>
                            <input class="form-control" type="text" id="admin_id" name="adminID" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" type="text" id="username" name="username" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="confPassword">Confirm Password</label>
                            <input class="form-control" type="password" id="confPassword" name="confirmPassword" required>
                        </div>

                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input class="form-control" type="text" id="firstname" name="firstname" required>
                        </div>

                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input class="form-control" type="text" id="lastname" name="lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="submit" class="sr-only">Submit</label>
                            <input class="form-control btn btn-lg bg-green" type="submit" id="submit" name="login" value="Register" required>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection