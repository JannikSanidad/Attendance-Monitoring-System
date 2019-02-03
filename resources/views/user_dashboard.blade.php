@extends('layouts.app')

@section('title')User Dashboard @endsection

@section('style')
<style type="text/css">

    .step-number {
        width:80px;
        font-weight:bold;
    }

    #logs td {
        padding:5px;
    }

    .card-body {
        padding-top: 8px;
        padding-bottom: 8px;
    }

    .form-group {
        margin-bottom:5px;
    }

    .card-header {
        padding-top: 5px;
        padding-bottom: 5px;
        color: #777;
    }

</style>
@endsection

@section('content')
<nav class="navbar navbar-expand-sm bg-light justify-content-center">
    <div class="container">
        <span class="navbar-brand">Attendance System</span>
        <ul class="nav navbar-nav">
            <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    
    <div class="row">
        <div class="col-md-8">

            <div id="steps">
                <table class="table table-striped table-responsive">
                    <tr>
                        <td class="step-number">Step 1</td>
                        <td>Make sure you have your <strong>University ID</strong> in order to scan for attendance.</td>
                    </tr>
                    <tr>
                        <td class="step-number">Step 2</td>
                        <td>Scan the barcode at the back of your University ID</td>
                    </tr>
                    <tr>
                        <td class="step-number">Step 3</td>
                        <td>Make sure that it is your information that shows on the screen.</td>
                    </tr>
                    <tr>
                        <td class="step-number">Step 4</td>
                        <td>After you scan your <strong>University ID</strong> a <strong>text message</strong> will be sent to your parents/guardian indicating that you have entered or exited the college.</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center"><strong>THANK YOU FOR USING THE UNIVERSITY ATTENDANCE SYSTEM!</strong><br><em>Note: Always bring your University ID: NO ID, NO ATTENDANCE.</em></td>
                    </tr>
                </table>
            </div>
            
            @if(Session::has('student_id'))
                <div class="card" id="student-div">
                    <div class="card-header">
                        Personal Data
                    </div>
                    <div class="card-body">
                        <table class="table borderless">
                            <td>
                                <img src="{{ asset('/image/img.jpeg') }}">
                            </td>
                            <td>
                                <table class="table">
                                    <tr>
                                        <th>Student Number:</th>
                                        <th>{{ $student['student_id'] }}</th>
                                    </tr>
                                    <tr>
                                        <th>Name:</th>
                                        <th>{{ $student['first_name'] }} {{ $student['last_name'] }}</th>
                                    </tr>
                                    <tr>
                                        <th>Course:</th>
                                        <th>{{ $student['course'] }}</th>
                                    </tr>
                                </table>
                            </td>
                        </table>
                    </div>
                </div>
            @endif
            <div id="error">
                @include('include.messages')    
            </div>
        </div>

        <div class="col-md-4" id="sidebar">

            <div class="card bg-light">
                <div class="card-body bg-blue">
                    <table cellpadding="0" class="table table-sm borderless">
                        <tr>
                            <td>Username:</td>
                            <td class="field-name">{{ $user['username'] }}</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td class="field-name">{{ $user['first_name'] }} {{ $user['last_name'] }}</td>
                        </tr>
                        <tr>
                            <td>Location:</td>
                            <td class="field-name">{{ $user['location'] }}</td>
                        </tr>
                        <tr>
                            <td>On Campus:</td>
                            <td><span id="on-campus-count"></span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body">
                    <form action="{{ route('scan') }}" method="post">
                        @csrf
                        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                        <div class="form-group">
                            <label for="system-status" class="sr-only">System Status</label>
                            <select id="system-status" name="attendance_type" class="form-control">
                                <option value="1">Time In</option>
                                <option value="0">Time Out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="studentID" class="label-control">Scan University ID</label><br>
                            <input class="form-control" type="text" id="studentID" name="studentID" onblur="this.focus()" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control btn btn-success" type="submit" value="Scan">
                        </div>
                    </form>
                </div>
            </div>

            <div class="card" id="faq">
                <div class="card-header">
                    Scanner Not Working?
                </div>
                <div class="card-body">
                    Please manually type student number
                </div>
            </div>
            
            <div class="card" id="email">
                <div class="card-body">
                    For assistance and technical support, please email us at: <span style="color:blue">itc-support@mmsu.edu.ph</span>
                </div>
            </div>

            <div class="card" id="log-div">
                <div class="card-body">
                    <div class="table-scrollable" style="height:300px;font-size:80%">
                        <table class="table table-striped" id="logs"></table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">

    // Set System Status = Time In / Time Out
    var temp = "<?php $system_status = Session::get('system_status'); echo $system_status ?>";

    var mySelect = document.getElementById('system-status');

    for(var i, j = 0; i = mySelect.options[j]; j++) {
        if(i.value == temp) {
            mySelect.selectedIndex = j;
            break;
        }
    }

    setInterval(function(){ 
        var currentlyShowing = "<?php $cur = Session::has('student_id'); echo $cur; ?>";
        if (currentlyShowing == 1) {
            var php = "<?php Session::forget('student_id') ?>";
            var student_div = document.getElementById('student-div');
            student_div.style.display = "none";
        }

        var error_div = document.getElementById('error');
        error_div.style.display = "none";
        
    }, 3000);
    
    // LOGS with AJAX

    setInterval(function(){
        $.get('{{ route("count") }}', function(data){
            document.getElementById("on-campus-count").innerHTML = data;
        });
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("logs").innerHTML = this.responseText;
                // console.log('this.responseText');
            }
        };
        xmlhttp.open("GET", "{{ URL::to('/logs') }}", true);
        xmlhttp.send();
    }, 1000);
</script>
@endsection