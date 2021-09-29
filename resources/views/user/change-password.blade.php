@extends('layouts.app')

@section('content')

<!-- Row -->
<div class="table-struct full-width full-height">
	<div class="table-cell vertical-align-middle auth-form-wrap">
		<div class="auth-form  ml-auto mr-auto no-float">
			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="sp-logo-wrap text-center pa-0 mb-30">
						<a href="index.html">
							<img class="brand-img mr-10" src="https://www.wave.ma/assets/svg/wave-logo.svg" alt="brand"/>
							<span class="brand-text">Wave RH</span>
						</a>
					</div>
					<div class="mb-30">
						<h3 class="text-center txt-dark mb-10">{{ __('Account Validation') }}</h3>
					</div>
					<div class="form-wrap">
					@if ($message = Session::get('error'))
					<div class="alert alert-danger">
						<p>{{ $message }}</p>
					</div>
					@endif

							<div class="form-group">
								<label class="pull-left control-label mb-10" for="email">{{ __('E-Mail Address') }}</label>
								<input type="text" class="form-control" required="" id="email" value="{{ $user->email }}" >
							</div>
							<form action="/user/change-password/{{ $user->id }}" method="POST">
								@csrf
								@method('put')
							<div class="form-group">
								<label class="pull-left control-label mb-10" for="password">{{ __('New Password') }}</label>
								<input type="password" class="form-control pr-password" required="" id="password" name="password" placeholder="Enter New pwd">

								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group">
								<label class="pull-left control-label mb-10" for="password-confirm">{{ __('Confirm Password') }}</label>
								<input type="password" class="form-control" required="" id="password-confirm" name="password_confirmation" placeholder="Re-Enter pwd">
								@error('password-confirm')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group text-center">
								<button type="submit" class="btn btn-info btn-rounded">{{ __('Validate') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Row -->
@endsection
