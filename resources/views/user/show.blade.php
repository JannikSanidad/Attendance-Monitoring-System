@extends('layouts.app')

@section('title')Show User @endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6 centered">
            <div class="card vertical-centered">
                <div class="card-header bg-light"><h1 class="title text-center">Admin Details</h1></div>
                <div class="card-body">
                    <table class="table table-bordered">
						<tr>
							<th>Admin ID</th>
							<td>{{ $user->admin_id }}</td>
						</tr>
						<tr>
							<th>Username</th>
							<td>{{ $user->username }}</td>
						</tr>
						<tr>
							<th>Name</th>
							<td>{{ $user->first_name }} {{ $user->last_name }}</td>
						</tr>
						<tr>
							<th>Login Status</th>
							<td><?php if($user->login_status == 1){echo 'Online';} else {echo 'Offline';} ?></td>
						</tr>
					</table>
					<a href="{{ route('users.index') }}" class="form-control btn bg-green">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection