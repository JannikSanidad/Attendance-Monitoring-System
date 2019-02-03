@extends('layouts.app')

@section('title')Landing Page @endsection

@section('style')
	<style type="text/css">

		body {
			background-color: #0c4b05;
			font-family: Garamond;
		}

		#title {
			color: #ffcd00;
			font-size: 550%;
			font-weight: bold;
			text-shadow: 2px 1px 1px black;
		}

		#sub-title {
			color: black;
			font-size: 400%;
			font-weight: bold;
			text-shadow: 1px 1px 1px #ffcd00;
		}

		.centered {
			/*margin:0 auto;*/
		}

		.vertical-centered {
			position: absolute;
		    top: 50%;
		    left:0;
		    transform: translateY(-50%);
		}

		#barcode {
			font-size:200%;
			margin:30px;
		}

		#mmsu-logo {
			position:relative;
			top:-50px;
			left:50px;
		}

		#itc-logo {
			position:relative;
			top:-50px;
			right:50px;
		}
	</style>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center vertical-centered">
			<img class="float-left" id="mmsu-logo" src="{{ asset('/image/mmsu.png') }}" width="300px">
			<img class="float-right" id="itc-logo" src="{{ asset('/image/itc.png') }}" width="300px">
			<h1 id="title">Mariano Marcos State University</h1>
			<h2 id="sub-title">Attendance Monitoring System</h2>
			<form action="{{ route('check_unlock') }}" method="post" class="">
				@csrf
				<div class="form-group">
					<label class="sr-only" for="barcode">User ID</label>
					<input class="col-sm-4 text-center" id="barcode" data-toggle="tooltip" title="Scan Barcode" type="password" name="admin_id" onblur="this.focus()" autofocus required>
				</div>
				<div class="form-group" style="width:400px;margin:0 auto">
					@include('include.messages')
				</div>
				
			</form>

		</div>
	</div>
</div>
@endsection