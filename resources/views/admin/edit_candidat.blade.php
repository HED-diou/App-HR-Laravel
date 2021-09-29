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


                                                            
                                                            <form action="/admin/candidat/update/{{$candidat->id}}" name="myForm" method="POST" autocomplete="off" enctype="multipart/form-data">
                                                                @csrf
                                                             <div class="form-body overflow-hide" style="padding: 15px;border: 1px solid rgba(33, 33, 33, 0.1);">
                                                                    <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>{{ __('Connection Infos') }}</h6>
														        	<hr class="light-grey-hr">

                                                                     <div class="form-group">
                                                                        <label class="control-label mb-10" for="email">{{ __('E-Mail Address') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                                            <input type="email" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" class="form-control"  id="email" name="email" placeholder="Enter email" value="{{ $candidat->email }}" autocomplete="email" autofocus>

                                                                        </div>
                                                                        @error('email')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    {{--
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
                                                                    </div> --}}

                                                                    <div class="form-group mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Family Status ') }}</label>


                                                                        <div class="checkbox checkbox-danger">
                                                                             <input id="admin" name="StatutFamiliale" value="0" type="hidden">
                                                                            <input id="admin1" name="StatutFamiliale" value="1" type="checkbox"   {{ $candidat->StatutFamiliale == 1 ? 'checked' : 'false'}} >
                                                                            <label for="StatutFamiliale">
                                                                                Single ?
                                                                            </label>
                                                                        </div>
                                                                        @error('StatutFamiliale')
                                                                            <span class=" text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group mb-30" style="display:flex;">
                                                                        <div>

                                                                        
                                                                        <label class="control-label mb-10 text-left">{{ __('Sexe') }}</label>
                                                                        <div class="radio radio-info">
                                                                            <input type="radio" name="Sexe" id="Sexe" value="1" checked="checked" autofocus required title="Sexe"
                                                                            {{ $candidat->Sexe == 1 ? 'checked' : 'checked'}}>
                                                                            <label for="Sexe">
                                                                            {{ __('Homme') }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio radio-info">
                                                                            <input type="radio" name="Sexe" id="inactif" value="0" value="{{ old('Sexe') }}"   autocomplete="statut" autofocus title="Sexe"
                                                                            {{ $candidat->Sexe == 0 ? 'checked' : 'false'}}  required>
                                                                            <label for="inactif">
                                                                            {{ __('Femme') }}
                                                                            </label>
                                                                        </div>
                                                                        {{-- <div class="radio radio-info">
                                                                            <input type="radio" name="Sexe" id="inactif" value="0" value="{{ old('statut') }}"  autocomplete="statut" autofocus title="Statut"
                                                                                  required>
                                                                            <label for="inactif">
                                                                            {{ __('Autre') }}
                                                                            </label>
                                                                        </div> --}}
                                                                        @error('Sexe')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                        
                                                                         </div>  
                                                                         <div style="padding-left:40%;">

                                                                        
                                                                            <label class="control-label mb-10 text-left">{{ __('Pattern ') }}</label>
                                                                            <div class="radio radio-info">
                                                                                <input type="radio" name="Motife" id="actif" value="1" checked="checked" autofocus required title="motife">
                                                                                <label for="actif">
                                                                                {{ __('Emploi') }}
                                                                                </label>
                                                                            </div>
                                                                            <div class="radio radio-info">
                                                                                <input type="radio" name="Motife" id="inactif" value="0" value="{{ old('statut') }}"  autocomplete="statut" autofocus title="Statut"
                                                                                {{ $candidat->motife == 0 ? 'checked' : 'false'}}   required>
                                                                                <label for="inactif">
                                                                                {{ __('Stage') }}
                                                                                </label>
                                                                            </div>
                                                                            @error('Motife')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                            
                                                                             </div>  
                                                                    </div>


                                                                    <div class="form-group mt-30 mb-30">
                                                                        @foreach ($technologie_candidats as $tc)
                                                                        <label  for=""> 
                                                                                {{ $tc->name }}
                                                                        </label><br>
                                                                        @endforeach 
                                                                        <label class="control-label mb-10 text-left">{{ __('Technologies') }}</label> <span style="color:red">*</span>
                                                                        <select class="form-control" id="technologies" multiple name="technologies[]" autocomplete="company" value="{{ old('company') }}"   autofocus  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please select an element from the list')" title="Please select an element from the list">
                                                                        <option value="" >None </option>
                                                                             @foreach ($technologies as $technologie)
                                                                                @if($technologie->active != 0)
                                                                                    
                                                                                        <option  <?php foreach($technologie_candidats as $tc){if($tc->name == $technologie->name){ echo 'selected';}}    ?>       value="{{ $technologie->id}}"{{ old('company') == $technologie->id ? 'selected' : ''}}>{{ $technologie->name }} </option>
                                                                                @endif
                                                                            @endforeach 
                                                                            
                                                                        </select>
                                                                        @error('technologies')
                                                                            <span class=" text-danger invalid-feedback" role="alert" >
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                        @foreach ($hobie_candidats as $c)
                                                                          <label for="">
                                                                              {{$c->name}}
                                                                          </label>
                                                                            @endforeach 
                                                                    <div class="form-group mt-30 mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Hobies') }}</label> <span style="color:red">*</span>
                                                                        <select class="form-control" id="hobies" name="hobies[]" multiple autocomplete="company" value="{{ old('hobies') }}"   autofocus  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please select an element from the list')" title="Please select an element from the list">
                                                                        <option > None </option>
                                                                             @foreach ($hobies as $hobie)
                                                                             @if($hobie->active != 0)
                                                                            <option <?php  foreach($hobie_candidats as $c){if($c->name == $hobie->name){ echo 'selected';}} ?> value="{{ $hobie->id}}" {{ old('hobie') == $hobie->id ? 'selected' : ''}}>{{ $hobie->name }} </option>
                                                                            @endif
                                                                            @endforeach 
                                                                        </select>
                                                                        @error('technologies')
                                                                            <span class=" text-danger invalid-feedback" role="alert" >
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="balance">{{ __("Years of Experience ") }}</label> <!--<span style="color:red">*</span>-->
                                                                        <div class="input-group" style="width:100%;">
                                                                        <input type="number" min="0"  max="60" step="1" id="NombreDanneesDexperience" name="NombreDanneesDexperience" class="form-control" value="{{ $candidat->NombreDanneesDexperience }}"  title="Balance must contain at least 0.5 as value">
                                                                    </div>
                                                                    @error('NombreDanneesDexperience')
                                                                        <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="balance1">{{ __('Salary assumption ') }}</label> <!--<span style="color:red">*</span>-->
                                                                        <div class="input-group" style="width:100%;">
                                                                        <input type="number" min="0"  max="15000" step="500" id="PretentionSalariale" name="PretentionSalariale" class="form-control" value="{{ $candidat->PretentionSalariale }}"  title="Balance must contain at least 0.5 as value" >
                                                                    </div>
                                                                    @error('PretentionSalariale')
                                                                        <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    
                                                                    </div>

                                                                    <div class="form-group mt-30 mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Appreciation ') }}</label>
                                                                        <select class="form-control" id="Appreciation" name="Appreciation" >
                                                                        <option value="" selected>peut-être </option>
                                                                            @foreach ($Appreciations as $Appreciation)
                                                                            <option value="{{ $Appreciation->id}}">{{ $Appreciation->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('Appreciation')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                        <div class="form-group">
                                                                        <label class="control-label mb-10 text-left">{{ __('Explication') }}</label>
                                                                        <textarea class="form-control" id="address" name="address" rows="5" value='{{$candidat->Adresse}}'>{{ old('address') }}</textarea>
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
                                                                            <input type="text" class="form-control" name="Nom" id="Nom"  value="{{$candidat->Nom}}" title="" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required">
                                                                        </div>
                                                                        @error('Nom')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="exampleInputuname_01">{{ __('Last Name') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="icon-user"></i></div>
                                                                            <input type="text" class="form-control" name="Prenom" id="Prenom"  value="{{$candidat->Prenom}}"  title="" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required">
                                                                        </div>
                                                                        @error('Prenom')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group mt-30 mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('City') }}</label>
                                                                        <select class="form-control" id="Ville" name="Ville" >
                                                                        <option value="{{$candidat->Ville}}" selected>{{$candidat->Ville}} </option>
                                                                            @foreach ($villes as $ville)
                                                                            <option value="{{ $ville->name}}" name="{{ $ville->name}}">{{ $ville->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('Ville')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="phone">{{ __('Contact Number') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="icon-phone"></i></div>
                                                                            <input type="tel" class="form-control" id="phone"  name="phone" value="{{$candidat->phone}}"  title="Phone number must contain 10 digits" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);" size="10" maxlength="10"  required="required">
                                                                        </div>
                                                                        @error('tel')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="DateNaissance">{{ __('Birth Date') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                           <input  type="date" class="form-control" id="DateNaissance" name="DateNaissance" value="{{$candidat->DateNaissance}}" autocomplete="off" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" title="">

                                                                        </div>
                                                                        @error('DateNaissance')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="EnArretDepuis">{{ __('Stopped Since ') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                            <input  type="date" class="form-control" id="EnArretDepuis" name="EnArretDepuis" value="{{$candidat->EnArretDepuis}}" autocomplete="off" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" title="">
                                                                        </div>
                                                                        @error('EnArretDepuis')
                                                                        <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="cin">{{ __('CIN') }}</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                                                            <input type="text" class="form-control" name="CIN" id="cin" value="{{$candidat->CIN}}" >
                                                                        </div>
                                                                        @error('CIN')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="cnss">{{ __('CV') }}</label>
                                                                        <div class="input-group">
                                                                            
                                                                            
                                                                                <div class="input-group-addon"><i class="fa fa-plus-square"></i>
                                                                                    <a href="{{asset('/storage/cv/cv_files/'.$candidat->CV)}}" > Download CV </a>
                                                                                </div>
                                                                           
                                                                                <input type="file" class="form-control" name="CV" id="CV" accept=
                                                                                'application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                                                                                text/plain, application/pdf, image/*' >
                                                                            
                                                                            
                                                                        </div>
                                                                        @error('CV')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="cnss">{{ __('Letter Cover') }}</label>
                                                                        <div class="input-group">
                                                                            
                                                                            
                                                                                <div class="input-group-addon"><i class="fa fa-plus-square"></i>
                                                                                    <a href="{{asset('/storage/cv/cv_files/'.$candidat->LettreMotivation)}}" > Download Letter Cover </a>
                                                                                </div>
                                                                           
                                                                                <input type="file" class="form-control" name="LettreMotivation" id="LettreMotivation" accept=
                                                                                'application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                                                                                text/plain, application/pdf, image/*' >
                                                                            
                                                                            
                                                                        </div>
                                                                        @error('LettreMotivation')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                            <label class="control-label mb-10 text-left">{{ __('Adress') }}</label>
                                                                            <textarea class="form-control" id="Adresse" name="Adresse" rows="5">{{$candidat->Adresse}}</textarea>
                                                                            @error('Adresse')
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
                                    <button type="submit" class="btn btn-success mr-15 mb-30" style="background: #333652;border: solid 1px #333652; margin-right: 15px;float: right;">{{ __('Update candidat') }}</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').selectpicker();
    });
</script>
@endsection
