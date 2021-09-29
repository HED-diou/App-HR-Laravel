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
		<link href="{{ asset('vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>



		<!-- Custom CSS -->
		<link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
	</head>
	<body>


		<div class="wrapper error-page pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
					<a href="/">
						<img class="brand-img mr-10" src="{{ asset('dist/img/wave-logo-2.png')}}" alt="Wave HR"/>
						<!-- <span class="brand-text">{{ __('Wave HR') }}</span> -->
					</a>
				</div>
				<div class="form-group mb-0 pull-right">
					<a class="inline-block btn btn-info btn-rounded btn-outline nonecase-font" href="/">Back to Home</a>
				</div>
				<div class="clearfix"></div>
			</header>

			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 error-bg-img">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="mb-30">
											<span class="block error-head text-center txt-info mb-10">404</span>
											<span class="text-center nonecase-font mb-20 block error-comment">{{ __('Page Not Found') }}</span>
											<p class="text-center">{{ __('The URL may be misplaced or the page you are looking is no longer available.') }}</p>
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
		<script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

		<!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>

		<!-- Slimscroll JavaScript -->
    	<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>

		<!-- Init JavaScript -->
	    <script src="{{ asset('dist/js/init.js') }}"></script>
	</body>
</html>
