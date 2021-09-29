<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Wave HR</title>
		<meta name="description" content="Wave HR application" />
		<meta name="keywords" content="" />
		<meta name="author" content="Wave INC."/>

		<!-- Favicon -->

        <link rel="icon" href="{{ asset('dist/img/favicon-wave.png') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('dist/img/favicon-wave.png') }}">
		<!-- vector map CSS -->
		<link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<!-- Custom CSS -->
		<link href="dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Preloader
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		/Preloader-->
		<div class="wrapper theme-1-active pimary-color-red">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="/">
						<img class="brand-img mr-10" src="{{ asset('dist/img/logoo.png') }}" alt="brand"/>
						<!-- <span class="brand-text">Hound</span> -->
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
				</div>
				<div class="clearfix"></div>
			</header>
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                        @if ($message = Session::get('warning'))
                                            <div class="alert alert-warning">
                                                <p>{{ $message }}</p>
                                            </div>
                                        @endif

                                        <div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">{{ __('Sign in to ') }}Wave HR</h3>
											<h6 class="text-center nonecase-font txt-grey">{{ __('Enter your details below') }}</h6>
										</div>
										<div class="form-wrap">
											<form method="POST" action="{{ route('login') }}">
											@csrf
												<div class="form-group">
													<label class="control-label mb-10" for="exampleInputEmail_2">{{ __('E-Mail Address') }}</label>
													<input type="email" oninvalid="InvalidMsg(this);" oninput="InvalidMsg(this);"  required="required" class="form-control"  id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" autocomplete="email" autofocus>

													@error('email')
														<span class=" err invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="exampleInputpwd_2">{{ __('Password') }}</label>
													<div class="clearfix"></div>
													<input  type="password"  required="required" oninvalid="validate(this);" oninput="validate(this);" class="form-control passerr"   id="password" name="password" placeholder="Enter password">

													@error('password')
														<span class="err invalid-feedback" role="alert">
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>

												<div class="form-group">
													<div class="checkbox checkbox-primary pr-10 pull-left">
														<input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
														<label for="remember"> {{ __('Keep me logged in') }}</label>
													</div>

													<div class="clearfix"></div>
												</div>

												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-rounded" style=" background: #004591 !important;border: solid 1px#004591 !important;">{{ __('Sign in') }}</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->

				</div>

			</div>
			<!-- /Main Content -->
		</div>
		<!-- /#wrapper -->
		<!-- JavaScript -->
		<!-- jQuery -->
		<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		<!-- Slimscroll JavaScript -->
		<script src="dist/js/jquery.slimscroll.js"></script>
		<!-- Init JavaScript -->
		<script src="dist/js/init.js"></script>
        <script >
            function InvalidMsg(textbox) {
                if (textbox.value === '') {
                    textbox.setCustomValidity
                    ('This field is necessary!');
                } else if (textbox.validity.typeMismatch) {
                    textbox.setCustomValidity
                    ('Please enter an email address which is valid!');
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            function validate(textbox) {
                var myInput = textbox.value;
                if (myInput.length < 6 && myInput.length > 0) {
                    textbox.setCustomValidity('The password must be at least 6 characters.');
                } else if (myInput=== '') {
                    textbox.setCustomValidity('The password is required , please fill in the field');
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
        </script>
    </body>
</html>
