@extends('layouts.app_login')
@section('content')


<body class="signup-page">
	<nav class="navbar navbar-transparent navbar-absolute">
    	<div class="container">
        	<!-- Brand and toggle get grouped for better mobile display -->
        	<div class="navbar-header">
        		<a class="navbar-brand" href="/">ABB Ports Kanban Board</a>
        	</div>
    	</div>
    </nav>

    <div class="wrapper">
		<div class="header header-filter" style="background-image: url('/img/crane.jpg'); background-size: cover; background-position: center;">
			<div class="container">
				<div class="row" style="margin-left: 0; margin-right: 0;">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="card card-signup">
							<form class="form" method="" action="">
								<div class="header header-primary text-center" style="margin-top: 0; box-shadow: none; margin: 0; border-radius: 3px 3px 0 0;">
									<h2>Log In</h2>
								</div>
								<p class="text-divider">Teamforge- or local user</p>
								<div class="content">

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
										<input type="text" class="form-control" placeholder="User Name...">
									</div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
										<input type="password" placeholder="Password..." class="form-control" />
									</div>

									<!-- If you want to add a checkbox to this form, uncomment this code

									<div class="checkbox">
										<label>
											<input type="checkbox" name="optionsCheckboxes" checked>
											Subscribe to newsletter
										</label>
									</div> -->
								</div>
								<div class="footer text-center">
									<a href="#pablopicasso" class="btn btn-simple btn-primary btn-lg">Teamforge</a>
									<a href="#pabloescobar" class="btn btn-simple btn-primary btn-lg">Local</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

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
</body>


@endsection
