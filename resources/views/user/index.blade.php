@extends('layouts.app')

@section('title')Admin Accounts @endsection

@section('content')
<nav class="navbar navbar-expand-sm bg-light justify-content-center">
    <div class="container">
        <span class="navbar-brand">Admin Panel</span>
        <ul class="nav navbar-nav">
            <a href="{{ route('logout') }}" class="nav-link">Logout<i class="fa fa-sign-out"></i></a>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin') }}" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{ route('admin_logs') }}" class="list-group-item list-group-item-action">Attendance Log</a>
                <a href="#" class="list-group-item list-group-item-action active">Accounts</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Admin Accounts
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm float-right">Create Account</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="account-table"></table>
                </div>    
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Are you sure you want to delete this account?
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
          <button class="btn btn-danger" onclick="deleteUser()" data-dismiss="modal">Delete</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    var admin_id; //for delete
    // Get the modal

    function deleteAdmin(data) {
        admin_id = data.name;
    }

    function deleteUser() {
        var dataString = "adminID="+admin_id;
        $.ajax({
            type: "POST",
            url: "{{ route('delete') }}",
            data: dataString,
            success: function(data){
                deleteModal.style.display = "none";
            }
        });
        
    }

    setInterval(function(){

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("account-table").innerHTML = this.responseText;
                // console.log('this.responseText');
            }
        };
        xmlhttp.open("GET", "{{ URL::to('/admin/accounts') }}", true);
        xmlhttp.send();
    }, 1000);
</script>
@endsection