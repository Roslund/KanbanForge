<?php
    if(Auth::guard('teamforge')->check()){
        $user = Auth::guard('teamforge')->user();
    }
    elseif(Auth::check()){
      $user = Auth::user();
    }
    else{
      $user = NULL;
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <!--<link rel="stylesheet" href="{{ url('/css/style.css')}}">-->
    <!--<link href="/css/select2.min.css" rel="stylesheet">-->
    <!-- CSS Files -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/material-kit.css') }}" rel="stylesheet"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link href='http://fonts.googleapis.com/css?family=Raleway:100,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,100' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Exo+2:200,300,100' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Exo:200,300,100' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <!-- our own css // andre -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/general.css') }}" />
    <link href="{{ asset('css/board.css') }}" rel="stylesheet">

    @yield('head')
  </head>

<body>
  <nav class="navbar navbar-default" id="navbar">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">ABB Ports Kanban Board</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">

    @if($user != NULL)
      @if($user->isadmin())
        <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons">dashboard</i>Dashboard<b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li><a href="{{ url('admin/filter') }}"><i class="material-icons">import_export</i>
          Select artifacts</a></li>
          <li><a href="{{ url('admin/categories') }}"> <i class="material-icons">view_week</i>
          Categories</a></li>
          <li><a href="{{ url('admin/swimlanes') }}"> <i class="material-icons">view_agenda</i>
          Swimlanes</a></li>
          <li><a href="{{ url('admin/parentcategories') }}"> <i class="material-icons">view_array</i>
          ParentCategories</a></li>
          <li><a href="{{ url('admin/projects') }}"> <i class="material-icons">description</i>
          Projects</a></li>
        </ul>
        </li>
      @endif

        <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons">account_circle</i>{{$user->username}}<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="/logout">
              <i class="material-icons">exit_to_app</i>
              Sign Out
              <div class="ripple-container"></div></a>
            </li>
          </ul>
        </li>
    @endif
      </ul>

      </div>
    </div>
  </nav>


    <div class="container">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      @yield('content')
    </div>
    <!-- In order for theme to work
    -- with functionalities such is the dropdown
    -- this should stay commented. Cheers, Amer
    -->
    <!-- JavaScripts -->
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <!--   Core JS Files   -->
    <script src="{{ URL::asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/material.min.js') }}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ URL::asset('js/nouislider.min.js') }}" type="text/javascript"></script>
    <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
    <script src="{{ URL::asset('js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
    <script src="{{ URL::asset('js/material-kit.js') }}" type="text/javascript"></script>

    @yield('kanbanBoardIncludes')
  </body>
</html>
