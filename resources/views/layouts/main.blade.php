<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <style type="text/css">
        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
    </style>




</head>
<body>
@include('layouts.partials.navbar')

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        {{Session::get('error')}}
    </div>
@endif

@if (session()->has('msg'))
    <p class="alert alert-success alert-dismissible fade show" id="alert" role="alert">{{ session('msg') }}
    </p>
@endif

<main class="p-5">
    @yield('content')
</main>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/mdb.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>


<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script !src="">
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

    $('.confirm').on('click', function (e) {
        return confirm($(this).data('confirm'));
    });
</script>


</body>
</html>
