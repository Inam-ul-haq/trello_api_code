<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Board Name</title>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="{{asset('css/css/fontawesome/css/all.css')}}" rel="stylesheet">
        <link href="{{asset('css/css/custom.css')}}" rel="stylesheet" type="text/css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="background">
        @if(request()->route()->parameters["isAdmin"] == "user")
<!-- 
        <nav class="navbar">
          <span class="navbar-brand text-white pl-5 ml-5 mb-0">Admin Panel</span>
        </nav> -->
       <!--  <nav class="navbar  text-white navbar-expand-sm bg-blue navbar-white"> -->
         <nav class="navbar">
          <span class="navbar-brand text-white pl-5 ml-4 mb-0 ">User Panel</span>
<!--           <span class="navbar-brand text-white pl-5 ml-5 mb-0"></span>
            -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div>
                <button class="btn btn-success btn-lg ml-2>
                    <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a>
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </div>
          <!--   <div class=" float right collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::is('bug-report/view') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('bug-report/view/user') }}"><span>View Bug</span> </a>
                    </li>
                    <li class="nav-item {{ Request::is('bug-report/add') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('bug-report/add/user') }}">
                            Add  Bug
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>
            </div> -->
        <!--     <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ Request::is('bug-report/view') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('bug-report/view/user') }}"><span>View Bug</span> </a>
                    </li>
                    <li class="nav-item {{ Request::is('bug-report/add') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('bug-report/add/user') }}">
                            Add  Bug
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
        </ul>
    </div> -->
        </nav>
        @else
           <!--  <nav class="navbar navbar-expand-sm bg-dark navbar-blue">
             
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">Admin Panel</a>
            </nav> -->
             <nav class="navbar">
              <span class="navbar-brand text-white pl-5 ml-5 mb-0">Admin Panel</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div>
                    <button class="btn btn-success btn-lg ml-2>
                        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a>
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    </form>
                </div>
            </nav>
        @endif
        @yield('content')
        @stack('scripts')
    </body>
</html>