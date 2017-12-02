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
							<div class="header header-primary text-center" style="margin-top: 0; box-shadow: none; margin: 0; border-radius: 3px 3px 0 0;">
								<h2>Sign In</h2>
							</div>
							
							<div class="content">
								<div class="text-center">
									<a href="https://www.collab.net/products/teamforge-alm" class="btn btn-simple btn-primary btn-lg" target="_blank">Teamforge</a>
									<button class="btn btn-primary btn-simple btn-lg" id="local-sign-in-btn">Local<div class="ripple-container"></div></button>
								</div>
								<form class="form-horizontal" method="POST" action="{{ route('login.submit') }}">
									{{ csrf_field() }}
									
									<div id="local-sign-in-form" style="display: none;">
										<hr style="margin: 0;">
										
										<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">face</i>
													</span>
													<input id="email" type="email" class="form-control" name="email" placeholder="Username" required autofocus>
													@if ($errors->has('email'))
													<span class="help-block">
														<strong>{{ $errors->first('email') }}</strong>
													</span>
													@endif
												</div>
											</div>
										</div>
										
										
										
										<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">lock_outline</i>
													</span>
													<input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
													@if ($errors->has('password'))
													<span class="help-block">
														<strong>{{ $errors->first('password') }}</strong>
													</span>
													@endif
												</div>
											</div>
										</div>
										
										
										<div class="form-group">
											<div class="col-md-8 col-md-offset-4">
												<button type="submit" class="btn btn-primary">
												Login
												</button>
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
	</div>
	
	<footer class="footer" style="position: absolute; bottom: 0; z-index: 10; text-align: center; width: 100%;">
		<div class="container">
			<
		</div>
	</footer>
</body>

<script type="text/javascript">
$("#local-sign-in-btn").one("click", function(){
	$("#local-sign-in-form").show(500);
});
</script>
@endsection
