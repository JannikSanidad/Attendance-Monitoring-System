@extends('layouts.app')

@section('title')Login @endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-6 centered">
			<div class="card vertical-centered">
				<div class="card-header bg-light"><h1 class="title text-center">Login</h1></div>
				<div class="card-body">
					<form action="{{ route('check_login') }}" method="post" >
						@csrf
						@include('include.messages')
						<input type="text" name="current_user" style="display:none" value="{{ $current_UID }}">

						<div class="form-group">
							<div class="row mt-3">
								<div class="col-md-3">
									<label for="username" class="control-label">Username</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>	
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-md-3">
									<label for="password" class="control-label">Password</label>
								</div>
								<div class="col-md-9">
									<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password"  required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-3">
									<div class="form-check">
										<input type="checkbox" id="event" name="isEvent" class="form-check-input" onclick="controlTextbox()">Event

									</div>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" id="eventbox" name="eventName" placeholder="Event Name" disabled>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-3">
									<label for="location control-label">Location</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" name="location" id="location">
										<option value="" disabled selected>Select location</option>
										<option value="ADMIN BLDG">ADMIN BLDG</option>
										<option value="LIBRARY">LIBRARY</option>
										<option value="ITC">ITC</option>
										<option value="CBEA">CBEA</option>
										<option value="COE">COE</option>
										<option value="CAS">CAS</option>
										<option value="CAS">CASAT</option>
										<option value="CAFSD">CAFSD</option>
										<option value="CHS">CHS</option>
										<option value="CTE">CTE</option>
										<option value="CIT">CIT</option>
									</select>
								</div>
							</div>
						</div>

						<input type="submit" class="form-control btn bg-green" name="login" value="Login">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	var event = document.getElementById('event');
	var eventbox = document.getElementById('eventbox');
	function controlTextbox(){
		if(event.checked){
			console.log('checked')
			eventbox.disabled = false;
		}
		else{
			console.log('notchecked')
			eventbox.disabled = true;
		}
	}
</script>
@endsection