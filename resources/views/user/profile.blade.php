@extends('layouts.app')

@section('content')
<div class="page-wrapper">
<div class="container-fluid">
<div class="row">

    <div class="col-lg-12 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div  class="panel-body pb-0">
                    <div  class="tab-struct custom-tab-1">
                        <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                            <li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>{{ __('Profile') }}</span></a></li>


                        </ul>
                        <div class="tab-content" id="myTabContent_8">
                            <div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
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
                                                                    @if ($errors->any())
                                                                    <div class="alert alert-danger">
                                                                      <strong>Warning!</strong> Please check input field code<br><br>
                                                                     <ul>
                                                                      @foreach ($errors->all() as $error)
                                                                         <li>{{ $error }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                    </div>
                                                                     @endif
                            <div class="row">
                                <form action="/profile/update/{{ Auth::user()->id }}" method="POST">
                                    <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                        <div class="">
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body pa-0">
                                                    <div class="col-sm-12 col-xs-12">

                                                        <div class="form-wrap">

                                                            <input type="hidden" name="oldpass" id="oldpass" value="{{ Auth::user()->password }}">

                                                                                      @csrf
                                                                    <div class="form-body overflow-hide" style="padding: 15px;border: 1px solid rgba(33, 33, 33, 0.1);">
                                                                                    <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>{{ __('Connection Infos') }}</h6>
                                                                                    <hr class="light-grey-hr">
																					<div class="form-group">
																						<label class="control-label mb-10" for="email">{{ __('E-Mail Address') }}</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																							<input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly="readonly">
																						</div>
                                                                                    </div>

                                                                                    <div class="form-group">
																						<label class="control-label mb-10" for="password">{{ __('Password') }}</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-lock"></i></div>
																							<input type="password" class="form-control pr-password" id="password" name="password" placeholder="Enter password" >
																						</div>
                                                                                        @error('password')
                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
																					</div>

																					<div class="form-group">
																						<label class="control-label mb-10" for="password-confirm">{{ __('Password Confirmation') }}</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-lock"></i></div>
																							<input type="password" class="form-control pr-password" id="password-confirm" name="password_confirmation" placeholder="Enter pwd confirmation" >
																						</div>
																					</div>

                                                                                    <div class="form-group mt-30 mb-30">
                                                                                        <label class="control-label mb-10 text-left">{{ __('Company') }}</label>
                                                                                        <div class="input-group">
                                                                                        <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                                                                        <select class="form-control" id="company" name="company_id" autocomplete="company" value="{{ old('company') }}"  disabled autofocus>
                                                                                        <option value="" selected>None </option>
                                                                                            @foreach ($companies as $company)
                                                                                            <option value="{{ $company->id}}" {{ $company->id == Auth::user()->company_id ? 'selected' : ''}}>{{ $company->name }} </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        </div>
                                                                                        @error('company')
                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>

                                                                                    <div class="form-group">
																						<label class="control-label mb-10" for="hiredate">{{ __('Hire Date') }}</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
																							<input type="date" class="form-control" id="hiredate" name="hiredate" value="{{ Auth::user()->hiredate }}" readonly autocomplete="off">
																						</div>
                                                                                    </div>

                                                                                  @if(isset($AuthUserManager[0]->firstname))
                                                                                        <div class="form-group">
                                                                                            <label class="control-label mb-10" for="manager">{{ __('Manager') }}</label>
                                                                                            <div class="input-group">
                                                                                                <div class="input-group-addon"><i class="icon-user"></i></div>
                                                                                                <input type="text" class="form-control" id="manager" name="manager"  value="{{ $AuthUserManager[0]->firstname }} {{ $AuthUserManager[0]->lastname }}" readonly>
                                                                                            </div>
                                                                                        </div>
																					@endif
                                                                                    <div class="form-group" >
																						<label class="control-label mb-10" for="balance">{{ __('Balance') }}</label>
                                                                                        <div class="input-group" style="width:100%;">
                                                                                            <input type="text" id="balance" name="balance" class="form-control" value="{{ Auth::user()->balance }}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                        <div class="">
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body pa-0">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="form-wrap">


                                                        <div class="form-body overflow-hide" style="padding: 15px;border: 1px solid rgba(33, 33, 33, 0.1);">
                                                                                    <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>{{ __('Personal Infos') }}</h6>
                                                                                    <hr class="light-grey-hr">
                                                                                    <div class="form-group">
																						<label class="control-label mb-10" for="firstname">{{ __('First Name') }}</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-user"></i></div>
																							<input type="text" class="form-control" name="firstname" id="firstname"  value="{{ Auth::user()->firstname }}" readonly>
																						</div>
                                                                                    </div>
                                                                                    <div class="form-group">
																						<label class="control-label mb-10" for="lastname">{{ __('Last Name') }}</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-user"></i></div>
																							<input type="text" class="form-control" name="lastname" id="lastname"  value="{{ Auth::user()->lastname }}"readonly >
																						</div>
                                                                                    </div>

                                                                                    <div class="form-group">
																						<label class="control-label mb-10" for="tel">{{ __('Contact Number') }}</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="icon-phone"></i></div>
																							<input type="text" class="form-control" id="tel"  name="tel" name="tel" value="{{ Auth::user()->tel }}">
																						</div>
                                                                                        @error('tel')
                                                                                            <span class="invalid-feedback" role="alert">
                                                                                                <strong>{{ $message }}</strong>
                                                                                            </span>
                                                                                        @enderror
                                                                                    </div>

                                                                                    <div class="form-group">
																						<label class="control-label mb-10" for="birthdate">{{ __('Birth Date') }}</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
																							<input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ Auth::user()->birthdate }}" readonly autocomplete="off">
																						</div>
                                                                                    </div>

                                                                                    <div class="form-group">
																						<label class="control-label mb-10" for="cin">{{ __('CIN') }}</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
																							<input type="text" class="form-control" name="cin" id="cin"  value="{{ Auth::user()->cin }}" readonly >
																						</div>
																					</div>

																					<div class="form-group">
																						<label class="control-label mb-10" for="cnss">{{ __('CNSS') }}</label>
																						<div class="input-group">
																							<div class="input-group-addon"><i class="fa fa-plus-square"></i></div>
																							<input type="text" class="form-control" name="cnss" id="cnss"  value="{{ Auth::user()->cnss }}" readonly>
																						</div>
																					</div>



																					<div class="form-group">
																							<label class="control-label mb-10 text-left">{{ __('Address') }}</label>
																							<textarea class="form-control" id="address" name="address" rows="5">{{ Auth::user()->address }}</textarea>
																						</div>





                                                                    <div class="form-actions mt-10">


                                                                </div>



                                                                </div>



                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                                    <button type="submit" class="btn btn-success mr-10 mb-30" style="background: #059ECB;border: solid 1px #059ECB; margin-right: 15px !important;float: right;">{{ __('Update Profile') }}</button>
                                    <a href="{{ route('admin.users') }}"><button  type="button" class="btn edit btn-github btn-icon-anim btn-square modal-btn" style="margin-left: 15px !important;" title="{{ __('Back') }}"><i class="fa fa-arrow-circle-left" ></i></button></a>

                                    </div>
                                                                        </form>

                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
</div>
<!-- /Row -->


<script>
    window.onload = function() {
        var admin = '{!! Auth::user()->admin !!}';

        if(admin == 1)
        {
            document.getElementById("email").readOnly = false;
            document.getElementById("firstname").readOnly = false;
            document.getElementById("lastname").readOnly = false;
            document.getElementById("cin").readOnly = false;
            document.getElementById("cnss").readOnly = false;
            document.getElementById("birthdate").readOnly = false;
            document.getElementById("hiredate").readOnly = false;
            document.getElementById("company").disabled = false;
        }
    };
</script>

@endsection
