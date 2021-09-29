@extends('layouts.app')

@section('content')
<div class="page-wrapper">
<div class="container-fluid pt-25">
<div class="row">

    <div class="col-lg-12 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div  class="panel-body pb-0">
                    <div  class="tab-struct custom-tab-1">
                        <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                            <li class="active" role="presentation"><a  class="underline" data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>{{ __('CREATE USER') }}</span></a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent_8">
                            <div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
                            <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                        <div class="">
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body pa-0">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="form-wrap">
                                                            <form action="{{ route('admin.store') }}" name="myForm" method="POST" autocomplete="off">
                                                                @csrf
                                                             <div class="form-body overflow-hide" style="padding: 15px;border: 1px solid rgba(33, 33, 33, 0.1);">
                                                                    <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>{{ __('Connection Infos') }}</h6>
														        	<hr class="light-grey-hr">

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="email">{{ __('E-Mail Address') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                                            <input type="email" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" class="form-control"  id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                                                        </div>
                                                                        @error('email')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="password">{{ __('Password') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                                            <input oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" type="password" class="form-control pr-password" id="password" name="password" placeholder="Enter password" title="" >
                                                                        </div>
                                                                        @error('password')
                                                                                <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="password-confirm">{{ __('Password Confirmation') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                                            <input oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" type="password" class="form-control" id="password-confirm" name="password_confirmation" title="" placeholder="Enter pwd confirmation"  >
                                                                        </div>
                                                                        @error('password_confirmation')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('User Role') }}</label>


                                                                        <div class="checkbox checkbox-danger">
                                                                             <input id="admin" name="admin" value="0" type="hidden">
                                                                            <input id="admin1" name="admin" value="1" type="checkbox"   {{ old('admin') == 1 ? 'checked' : 'false'}} >
                                                                            <label for="admin1">
                                                                                Administrator
                                                                            </label>
                                                                        </div>
                                                                        @error('admin')
                                                                            <span class=" text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>


                                                                    <div class="form-group mt-30 mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Company') }}</label> <span style="color:red">*</span>
                                                                        <select class="form-control" id="company" name="company_id" autocomplete="company" value="{{ old('company') }}"   autofocus  required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please select an element from the list')" title="Please select an element from the list">
                                                                        <option value="" selected>None </option>
                                                                            @foreach ($companies as $company)
                                                                            <option value="{{ $company->id}}" {{ old('company') == $company->id ? 'selected' : ''}}>{{ $company->name }} </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('company')
                                                                            <span class=" text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group mt-30 mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Manager') }}</label>
                                                                        <select class="form-control" id="manager" name="manager" >
                                                                        <option value="" selected>None </option>
                                                                            @foreach ($managers as $manager)
                                                                            <option value="{{ $manager->id}}" {{ old('manager') == $manager->id ? 'selected' : ''}}>{{ $manager->firstname }} {{ $manager->lastname }} </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('manager')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Statut') }}</label>
                                                                        <div class="radio radio-info">
                                                                            <input type="radio" name="statut" id="statut" value="1" checked="checked" autofocus required title="Statut"
                                                                              {{(old('statut') == 0) ? 'checked' : 'checked'}}>
                                                                            <label for="statut">
                                                                            {{ __('Actif') }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio radio-info">
                                                                            <input type="radio" name="statut" id="inactif" value="0" value="{{ old('statut') }}"  autocomplete="statut" autofocus title="Statut"
                                                                                 {{(old('statut') == 0) ? 'checked' : 'false'}} required>
                                                                            <label for="inactif">
                                                                            {{ __('Inactif') }}
                                                                            </label>
                                                                        </div>
                                                                        @error('statut')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="balance">{{ __('Balance') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group" style="width:100%;">
                                                                        <input type="number" min="0.5"  max="40" step="0.5" id="balance" name="balance" class="form-control" value="{{ old('balance') }}"  title="Balance must contain at least 0.5 as value" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required">
                                                                    </div>
                                                                    @error('balance')
                                                                        <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
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
                                                                        <label class="control-label mb-10" for="firstname">{{ __('First Name') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="icon-user"></i></div>
                                                                            <input type="text" class="form-control" name="firstname" id="firstname"  value="{{ old('firstname') }}" title="" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required">
                                                                        </div>
                                                                        @error('firstname')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="exampleInputuname_01">{{ __('Last Name') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="icon-user"></i></div>
                                                                            <input type="text" class="form-control" name="lastname" id="lastname"  value="{{ old('lastname') }}"  title="" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required">
                                                                        </div>
                                                                        @error('lastname')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="tel">{{ __('Contact Number') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="icon-phone"></i></div>
                                                                            <input type="tel" class="form-control" id="tel"  name="tel" name="tel" value="{{ old('tel') }}"  title="Phone number must contain 10 digits" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);" size="10" maxlength="10"  required="required">
                                                                        </div>
                                                                        @error('tel')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="birthdate">{{ __('Birth Date') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                           <input  type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" autocomplete="off" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" title="">

                                                                        </div>
                                                                        @error('birthdate')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="hiredate">{{ __('Hire Date') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                            <input  type="date" class="form-control" id="hiredate" name="hiredate" value="{{ old('hiredate') }}" autocomplete="off" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" title="">
                                                                        </div>
                                                                        @error('hiredate')
                                                                        <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="cin">{{ __('CIN') }}</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                                                            <input type="text" class="form-control" name="cin" id="cin" value="{{ old('cin') }}" >
                                                                        </div>
                                                                        @error('cin')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="cnss">{{ __('CNSS') }}</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-plus-square"></i></div>
                                                                            <input type="text" class="form-control" name="cnss" id="cnss"  value="{{ old('cnss') }}" >
                                                                        </div>
                                                                        @error('cnss')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                            <label class="control-label mb-10 text-left">{{ __('Address') }}</label>
                                                                            <textarea class="form-control" id="address" name="address" rows="5">{{ old('address') }}</textarea>
                                                                            @error('address')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                                    <button type="submit" class="btn btn-success mr-15 mb-30" style="background: #333652;border: solid 1px #333652; margin-right: 15px;float: right;">{{ __('Create Profile') }}</button>
                                    <a href="{{ route('admin.users') }}"><button  type="button" class="btn edit btn-github btn-icon-anim btn-square modal-btn" style="margin-left: 15px !important;" title="{{ __('Back') }}"><i class="fa fa-arrow-circle-left" ></i></button></a>
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
</div>
<!-- /Row -->

@endsection
