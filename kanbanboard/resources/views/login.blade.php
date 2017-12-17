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
							<div class="header header-primary text-center">
								<h2>Sign In</h2>
							</div>

							<div class="content" style="padding-left:30px; padding-right:50px;">

								<form class="form-horizontal" method="POST" action="{{ route('login.submit') }}">
									{{ csrf_field() }}
									<div id="local-sign-in-form">

										<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">face</i>
													</span>
													<input id="username" type="text" class="form-control" name="username" placeholder="Username" required autofocus>
													@if ($errors->has('username'))
													<span class="help-block">
														<strong>{{ $errors->first('username') }}</strong>
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

	<footer class="footer">
		<div class="container">

		</div>
	</footer>
</body>

<script type="text/javascript">
$("#local-sign-in-btn").one("click", function(){
	$("#local-sign-in-form").show(500);
});
</script>
@endsection
