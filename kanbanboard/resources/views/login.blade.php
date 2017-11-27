@extends('layouts.app_login')

@section('head')

	<title>Sign In</title>

@endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>




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
							<form class="form" method="post" action="">
								<div class="header header-primary text-center" style="margin-top: 0; box-shadow: none; margin: 0; border-radius: 3px 3px 0 0;">
									<h2>Sign In</h2>
								</div>
								
								<div class="content">
									<div class="text-center">
										<a href="https://www.collab.net/products/teamforge-alm" class="btn btn-simple btn-primary btn-lg">Teamforge</a>
										<button class="btn btn-primary btn-simple btn-lg" id="local-sign-in-btn">Local<div class="ripple-container"></div></button>
									</div>

									<div id="local-sign-in-form" style="display: none;">
										<hr style="margin: 0;">
										<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
										<input type="text" class="form-control" placeholder="Username" required>
										</div>

										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">lock_outline</i>
											</span>
											<input type="password" placeholder="Password" class="form-control" required>
										</div>
										<div class="footer text-center">
											<button class="btn btn-primary btn-simple btn-lg">Sign In<div class="ripple-container"></div></button>
										</div>
									</div>
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

<script type="text/javascript">
    $("#local-sign-in-btn").click(function(){
        $("#local-sign-in-form").show(500);
    });
</script>
@endsection
