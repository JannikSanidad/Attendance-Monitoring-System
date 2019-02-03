@extends('layouts.app')

@section('title')Admin Dashboard @endsection

@section('style')
<style type="text/css">
    form {
        margin-bottom:10px;
    }

    .form-control {
        width:30%;
    }

    .accordion-item {
        color:#777;
    }

    .accordion-item:hover {
        cursor:pointer;
    }

    #counter-table {
        font-weight:bold;
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
                <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                <a href="{{ route('admin_logs') }}" class="list-group-item list-group-item-action">Attendance Log</a>
                <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action">Accounts</a>
            </div>
            <div class="card" style="margin-top:30px">
                <div class="card-header">
                    Students on campus
                </div>
                <div class="card-body">
                    <div id="campus-counters"></div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="btn-group" role="group" style="margin-bottom:10px">
                <button type="button" class="btn bg-blue" onclick="populateTable('ADMIN BLDG')">ADMIN</button>
                <button type="button" class="btn bg-blue" onclick="populateTable('LIBRARY')">LIBRARY</button>
                <button type="button" class="btn bg-blue" onclick="populateTable('ITC')">ITC</button>
                <button type="button" class="btn bg-blue" onclick="populateTable('CBEA')">CBEA</button>
                <button type="button" class="btn bg-blue" onclick="populateTable('COE')">COE</button>
                <button type="button" class="btn bg-blue" onclick="populateTable('CAS')">CAS</button>
                <button type="button" class="btn bg-blue" onclick="populateTable('CAS')">CASAT</button>
                <button type="button" class="btn bg-blue" onclick="populateTable('CAFSD')">CAFSD</button>
                <button type="button" class="btn bg-blue" onclick="populateTable('CHS')">CHS</button>
                <button type="button" class="btn bg-blue" onclick="populateTable('CTE')">CTE</button>
                <button type="button" class="btn bg-blue" onclick="populateTable('CIT')">CIT</button>
            </div>

            <div class="card">
                <div class="card-header">
                    <span id="card-title">ADMIN BLDG</span>
                </div>
                <div class="card-body">
                    <input class="form-control" id="search" type="text" name="search" placeholder="Search..." style="margin-bottom:10px">
                    <table class="table table-striped" id="oncampus-table"></table>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection

@section('script')
<script type="text/javascript">
    var current_location = "ADMIN BLDG";
    var search_item="";
    
    function populateTable(location){
        current_location = location;
        $('#card-title').html(location);
    }

    $("#search").on("keyup", function() {
        search_item = $(this).val();
    });

    $(document).ready(function(){
                
        setInterval(function(){

            var dataString = "location="+current_location+"&search_item="+search_item;
            $.ajax({
                type: "POST",
                url: "{{ route('oncampus_logs') }}",
                data: dataString,
                success: function(data){
                    document.getElementById("oncampus-table").innerHTML = data;
                }
            });

            $.get('getCampusCount', function(data){
                document.getElementById("campus-counters").innerHTML = data;
            });

        }, 500);
    }); 

</script>
@endsection