<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Select2 -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/select2/css/select2.min.css')}}">

    <!-- Datatables -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{URL::asset('assets/img/logo/favicon.ico')}}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">ARVIFIELD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link  @if(Request::segment(1) == ''){{'active'}} @endif" aria-current="page" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(1) == 'resource'){{'active'}} @endif" href="{{route('resource')}}">Resource</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(1) == 'category'){{'active'}} @endif" href="{{route('category')}}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(Request::segment(1) == 'source'){{'active'}} @endif" href="{{route('source')}}">Source</a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <div class="container">
        @yield('page')
    </div>

    <!-- Bootstrap -->
    <script src="{{URL::asset('assets/js/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Sweet Alert -->
    <script src="{{URL::asset('assets/js/sweetalert2/sweetalert2.all.min.js')}}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{URL::asset('assets/js/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    @stack('plugin')

    <script src="{{URL::asset('assets/js/ScriptSweetalert2.js')}}"></script>
</body>

</html>