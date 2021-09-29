<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Wave HR</title>
	<meta name="description" content="Wave HR application" />
	<meta name="keywords" content="" />
	<meta name="author" content="Wave INC."/>

	<!-- Favicon
	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> -->
    <link rel="icon" href="{{ asset('dist/img/favicon-wave.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('dist/img/favicon-wave.png') }}">


    <!-- Morris Charts CSS -->
    <link href="{{ asset('vendors/bower_components/morris.js/morris.css') }}" rel="stylesheet" type="text/css"/>

	<!-- Data table CSS -->
	<link href="{{ asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>

	<link href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">

	<!-- Custom CSS -->
	<link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">

	<!-- Custom CSS -->
	<link href="{{ asset('dist/css/jquery.passwordRequirements.css') }}" rel="stylesheet" type="text/css">

	<!-- switchery CSS -->
	<link href="{{ asset('vendors/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css">

	<!-- jQuery UI -->
	<link rel="stylesheet" href="{{ asset('dist/css/jquery-ui.css') }}">
    <link href="{{ asset('dist/css/main.css') }}" rel="stylesheet" type="text/css">
    <style>
        #calendar{
            max-width: 100%;
            margin: 0 auto 0;
        }
        .fa-group:before, .fa-users:before {
            content: "\f0c0";
        }

        @media only screen and (max-width: 578px) {
            .fc-dayGridMonth-button, .fc-dayGridWeek-button, .fc-dayGridDay-button, .fc-today-button, .fc-prevYear-button, .fc-nextYear-button{
                display: none !important;
            }
            .fc-toolbar-title{
                font-size: 1.2em !important;
            }
            .request-dash{
                font-size: 12px;
                font-weight: normal;
                        }
        }
        @media only screen and (max-width: 646px) {
            .fc-toolbar-title{
                font-size: 1.7em !important;
            }
        }
        .clicked{
            cursor: pointer;
        }
        .liste{
            list-style: square;color: white ;text-align: left ; margin-left: 44px
        }
        .navbar.navbar-inverse.navbar-fixed-top .nav-header .logo-wrap .brand-img {
            margin-right: 10px;
            position: relative;
            top: -1px;
        }
    </style>

</head>
<body>

    <div class="wrapper theme-1-active pimary-color-red">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top slide-nav-toggle">
			@if(Auth::check())
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">

				 <div class="logo-wrap">

                         @guest
                             @if (Route::has('login'))
                             <a href="/">
                                 <img class="brand-img"  src="{{ asset('dist/img/wave-logo-2.png') }}" alt="brand"/>
                                 <!-- <span class="brand-text">Wave RH</span>  -->
                             </a>
                             @endif
                         @else
                         @if(Auth::user()->hasRole('admin'))
                             <a href="{{ route('admin') }}" >
                                 <img class="brand-img"  src="{{ asset('dist/img/wave-logo-2.png') }}" alt="brand"/>
                                 <!-- <span class="brand-text">Wave RH</span>  -->
                             </a>
                             @else
                             <a href="{{ route('admin') }}" >
                                 <img class="brand-img"  src="{{ asset('dist/img/wave-logo-2.png') }}" alt="brand"/>
                                 <!-- <span class="brand-text">Wave RH</span>  -->
                             </a>
                         @endif
                     @endguest
					</div>
                    <div class="logo-wrapp">

                         @guest
                             @if (Route::has('login'))
                             <a href="/">
                                 <img class="brand-img"  src="{{ asset('dist/img/favicon-wave.png') }}" alt="brand"/>
                                 <!-- <span class="brand-text">Wave RH</span>  -->
                             </a>
                             @endif
                         @else
                         @if(Auth::user()->hasRole('admin'))
                             <a href="{{ route('admin') }}" >
                                 <img class="brand-img"  src="{{ asset('dist/img/favicon-wave.png') }}" alt="brand"/>
                                 <!-- <span class="brand-text">Wave RH</span>  -->
                             </a>
                             @else
                             <a href="{{ route('admin') }}" >
                                 <img class="brand-img"  src="{{ asset('dist/img/favicon-wave.png') }}" alt="brand"/>
                                 <!-- <span class="brand-text">Wave RH</span>  -->
                             </a>
                         @endif
                     @endguest
					</div>
				</div>

				 <a id="toggle_nav_btn"  class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>

				<!-- SEARCH BAR DISABLED MOBILE <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a> -->
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
			</div>
			@endif

			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">
					@guest
						@if (Route::has('login'))
							<li>
								<a href="{{ route('login') }}" class="" >{{ __('Login') }}</a>
							</li>
						@endif
                    @else
                    <li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">{{ Auth::user()->firstname }}</span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                                @if(Auth::user()->connected_at != NULL || Auth::user()->hasRole('admin'))
                                <li>
                                    <a href="{{ route('user.profile') }}"><i class="zmdi zmdi-account"></i><span>{{ __('Profile') }}</span></a>
                                </li>
                                @endif
							<li>
								<a href="#"><i class="zmdi zmdi-card"></i><span>{{ __('Balance : ') }}{{Auth::user()->balance}}</span></a>
							</li>


							<li class="divider"></li>
							<li>
								<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</li>
						</ul>
                    </li>
                    @endguest
				</ul>
			</div>
		</nav>
		<!-- /Top Menu Items -->

		@if(Auth::check())
		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
                <li class="navigation-header">
                    <span>Main</span>
                    <i class="zmdi zmdi-more"></i>
                </li>
				@if(Auth::user()->hasRole('admin'))
					<li>
						<a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><div class="pull-left"><i class="fa fa-users mr-20"></i><span class="right-nav-text">Candidat</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
						<ul id="dashboard_dr" class="collapse collapse-level-1">
							<li>
								<a  href="/admin/candidat">{{ __('candidat List') }}</a>
							</li>
							<li>
								<a  href="/admin/candidat/create">{{ __('Create candidat ') }}</a>
							</li>
                            <li>
								<a  href="/admin/candidat/TH">{{ __('Hobies/Technologies') }}</a>
							</li>
						</ul>
					</li>
				@endif
				@if(Auth::user()->hasRole('admin'))
					<li>
						<a href="javascript:void(0);" data-toggle="collapse" data-target="#candidat"><div class="pull-left"><i class="fa fa-users mr-20"></i><span class="right-nav-text">{{ __('Users') }}</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
						<ul id="candidat" class="collapse collapse-level-1">
							<li>
								<a  href="/admin/users">{{ __('Users List') }}</a>
							</li>
							<li>
								<a  href="/admin/users/create">{{ __('Create User ') }}</a>
							</li>
						</ul>
					</li>
				@endif
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><div class="pull-left"><i class="fa fa-plane mr-20"></i><span class="right-nav-text">{{ __('Holiday Requests') }}</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ecom_dr" class="collapse collapse-level-1">
					    <li>
							<a href="/requests">{{ __('Requests List') }}</a>
						</li>
                        <li>
                            <a href="/requests/create">{{ __(' Create Request') }}</a>
                        </li>
					</ul>
				</li>
                    @if(Auth::user()->hasRole('admin'))
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#bank" ><div class="pull-left"><i class="fa  fa-cogs mr-20"></i><span class="right-nav-text">{{ __('Settings') }} </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="bank" class="collapse collapse-level-1">
                        <li>
                            <a href="/bank_holidays/annees">{{ __('Bank Holidays List') }}</a>
                        </li>
                        <li>
                            <a href="/bank_holidays">{{ __('Create Bank holiday ') }}</a>
                        </li>
                        <li>
                            <a href="/setting/cron">{{ __('Update the balance') }}</a>
                        </li>
					</ul>
				</li>
                    @endif
                    <li><hr class="light-grey-hr mb-10"/></li>
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->
		@endif
		<!-- Main Content -->
		<!-- Row -->
		@yield('content')
		<!-- Row -->
        <!-- /Main Content -->
    </div>
    <!-- /#wrapper -->
	<!-- jQuery -->
    <script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

	<script src="{{ asset('dist/js/jquery-ui.js') }}"></script>

	<script>
	/* Start Date & End Date Control */

	function actionform(id){
		var action_button = document.getElementById(id).value ;
		document.getElementById("myform").action = action_button;
        }
	</script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

	<!-- Data table JavaScript -->
	<script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>

	<!-- Slimscroll JavaScript -->
	<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>

	<!-- simpleWeather JavaScript -->
	<script src="{{ asset('vendors/bower_components/moment/min/moment.min.js') }}"></script>
	<script src="{{ asset('vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
	<script src="{{ asset('dist/js/simpleweather-data.js') }}"></script>

	<!-- Progressbar Animation JavaScript -->
	<script src="{{ asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>

	<!-- Fancy Dropdown JS -->
	<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>

	<!-- Owl JavaScript -->
	<script src="{{ asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>

	<!-- ChartJS JavaScript -->
	<script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>

	<!-- Morris Charts JavaScript -->
    <script src="{{ asset('vendors/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

	<!-- Switchery JavaScript -->
	<script src="{{ asset('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
	<script src="{{ asset('dist/js/sweetalert2.js') }}"></script>
	<script src="{{ asset('dist/js/form-advance-data.js') }}"></script>

	<!-- Password Requirements- -->
	<script src="{{ asset('dist/js/jquery.passwordRequirements.js') }}"></script>

	<!-- Wave Custom Js- -->
	<script src="{{ asset('dist/js/wave.js') }}"></script>

	<!-- Init JavaScript -->
	<script src="{{ asset('dist/js/init.js') }}"></script>
    <script src="{{ asset('dist/js/main.js') }}"></script>

    <!--<script src="{{ asset('dist/js/dashboard-data.js') }}"></script>-->

</body>
<script >
    // fonction de suppression d'un jour férié
    function suppr(id,year) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('idddd2  '+id);
                $.ajax({
                    type: "POST",
                    url: "{{url('/delete')}}",
                    data: {id: id,"_token":"{{ csrf_token() }}"},
                    success: function (data) {
                        if(data=="yess"){
                            Swal.fire(
                                'was Deleted!',
                                'The bankday has been deleted.',
                                'success'
                            ),
                                window.location.href='/bank_holidays/annees/listing/' +year ;
                        }
                    }
                });
            }
        })
    }
</script>
</html>
