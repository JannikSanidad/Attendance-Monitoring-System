@if(session('success'))
	<div class="alert alert-success alert-dismissible" style="margin:10px auto">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{ session('success') }}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger alert-dismissible" style="margin:10px auto">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{ session('error') }}
	</div>
@endif