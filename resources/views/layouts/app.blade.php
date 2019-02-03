<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AMS - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <!--  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

    <style type="text/css">

        body {
            background-color:white;
        }

        .bg-green {
            background-color:#4fc08d;
            color:white;
        }

        .bg-green:hover {
            background-color:#28a745;
        }

        .bg-blue {
            background-color: #35495e;
            color:white;
        }

        .title {
        font-weight:bold;
            color:#777;
        }

        .centered {
            margin:0 auto;
        }

        .vertical-centered {
            position:relative;
            top:20%;
        }

        .table-scrollable {
            overflow:scroll;
        }

        .card {
            margin-bottom:10px;
        }

        .navbar {
            margin-bottom:10px;
        }

        .borderless {
            margin-bottom:0;
        }

        .borderless td {
            border:none;
        }

        .list-group-item.active {
            background-color: #4fc08d;
            border-color: #4fc08d;
        }

        .nav-link {
            color:#777;
        }
    </style>
    @yield('style')
</head>
<body>
    @yield('content')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('script')

    
</body>
</html>