@extends('layouts.app')

@section('title')Admin Dashboard @endsection

@section('style')
<style type="text/css">
    form {
        margin-bottom:10px;
    }
</style>
@endsection

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
                <a href="#" class="list-group-item list-group-item-action active">Attendance Log</a>
                <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action">Accounts</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Attendance Log
                </div>
                <div class="card-body">
                    <form id="form" action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="calendar-one">Start Date</label>
                                    <input type="date" name="search-date-start" class="form-control" id="calendar-one"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="calendar-two">End Date</label>
                                    <input type="date" name="search-date-end" class="form-control" id="calendar-two">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-control" id="dropdown" onchange="dropdown_change()">
                                    <option value="NULL">Filter by</option>
                                    <option value="student_id">Student No.</option>
                                    <option value="name">Name</option>
                                    <option value="location">Location</option>
                                </select>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="search" id="search-box" class="form-control" placeholder="Search..">
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-scrollable" style="height:500px">
                        <table class="table table-striped" id="logs-table"></table>
                    </div>
                </div>    
            </div>
        </div>
    </div>    
</div>
@endsection

@section('script')
<script type="text/javascript">
        
    var dropdown = document.getElementById('dropdown');
    var search_box = document.getElementById('search-box');

    search_box.disabled = true;    
    
    function dropdown_change() {
        if (dropdown.value == "NULL") {
            search_box.disabled = true;
        } else {
            search_box.disabled = false;
        }
    }

    $(document).ready(function(){
        setInterval(function(){
            var startDate = $('#calendar-one').val();
            var endDate = $('#calendar-two').val();
            var search_with = dropdown.value;
            var search_item = $('#search-box').val();

            var dataString = "startDate="+startDate+"&endDate="+endDate+"&search_with="+search_with+"&search_item="+search_item;
            $.ajax({
                type: "POST",
                url: "{{ route('search') }}",
                data: dataString,
                success: function(data){
                    document.getElementById("logs-table").innerHTML = data;
                }
            });
        }, 500);
    }); 
       
        
</script>
@endsection