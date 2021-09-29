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
                                                            <form action="{{ route('admin.store_c') }}" name="myForm" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                                                                        <label class="control-label mb-10 text-left">{{ __('Family Status') }}</label>


                                                                        <div class="checkbox checkbox-danger">
                                                                             <input id="admin" name="StatutFamiliale" value="0" type="hidden">
                                                                            <input id="admin1" name="StatutFamiliale" value="1" type="checkbox"   {{ old('admin') == 1 ? 'checked' : 'checked'}} >
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
                                                                              >
                                                                            <label for="Sexe">
                                                                            {{ __('Homme') }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="radio radio-info">
                                                                            <input type="radio" name="Sexe" id="inactif" value="0" value="{{ old('Sexe') }}"  autocomplete="statut" autofocus title="Sexe"
                                                                                  required>
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

                                                                        
                                                                            <label class="control-label mb-10 text-left">{{ __('Pattern') }}</label>
                                                                            <div class="radio radio-info">
                                                                                <input type="radio" name="Motife" id="actif" value="1" checked="checked" autofocus required title="motife"
                                                                                  >
                                                                                <label for="actif">
                                                                                {{ __('Emploi') }}
                                                                                </label>
                                                                            </div>
                                                                            <div class="radio radio-info">
                                                                                <input type="radio" name="Motife" id="inactif" value="0" value="{{ old('statut') }}"  autocomplete="statut" autofocus title="Statut"
                                                                                      required>
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


                                                                    {{-- <div class="form-group mt-30 mb-30">
                                                                    <select multiple data-placeholder="Add tools" name="haitam">
                                                                        <option name="haitam">Sketch</option>
                                                                        <option name="haitam" selected>Framer X</option>
                                                                        <option name="haitam" >Photoshop</option>
                                                                        <option name="haitam" >Principle</option>
                                                                        <option name="haitam">Invision</option>
                                                                    </select>
                                                                    
                                                                    <!-- dribbble -->
                                                                    <a class="dribbble" href="https://dribbble.com/shots/5112850-Multiple-select-animation-field" target="_blank"><img src="https://cdn.dribbble.com/assets/dribbble-ball-1col-dnld-e29e0436f93d2f9c430fde5f3da66f94493fdca66351408ab0f96e2ec518ab17.png" alt=""></a>
                                                                    </div> --}}


                                                                    <style type="text/css">
                                                                        .dropdown-toggle{
                                                                            height: 40px;
                                                                            width: 400px !important;
                                                                        }
                                                                    </style>



                                                                    <div class="form-group mt-30 mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Technologies') }}</label> <span style="color:red">*</span>
                                                                        <select class="form-control" id="technologies" data-live-search="true" name="technologies[]" autocomplete="company" value="{{ old('company') }}"   autofocus  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please select an element from the list')" title="Please select an element from the list" multiple >
                                                                        <option value="" selected>None </option>
                                                                             @foreach ($technologies as $technologie)
                                                                            <option value="{{ $technologie->id}}">{{ $technologie->name }} </option>
                                                                            @endforeach 
                                                                        </select>
                                                                        @error('technologies')
                                                                            <span class=" text-danger invalid-feedback" role="alert" >
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- <div class="form-group mt-30 mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Hobies') }}</label>
                                                                        <select class="form-control" id="manager" name="manager" >
                                                                        <option value="" selected>None </option>
                                                                            @foreach ($hobies as $hobie)
                                                                             <option value="{{ $hobie->id}}">{{ $hobie->name}} </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('Hobies')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div> --}}
                                                                    
                                                                    <?php /*
                                                                    $d=[];
                                                                    $i = 0;
                                                                    foreach($hobies as $hobie){
                                                                    $d[$i] = $hobie->name;
                                                                    $i++;
                                                                    }
                                                                    */?>
                                                                    {{-- <div class="select-item-list--single"">
                                                                        <h4>Multi Select</h4>
                                                                        <div class="directorist-select directorist-select-multi" id="multiSelect" data-isSearch="true" data-max="2" data-multiSelect="" >               
                                                                            <input type="hidden">
                                                                        </div>
                                                                    </div> --}}
                                                                    <div class="form-group mt-30 mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Hobies') }}</label> <span style="color:red">*</span>
                                                                        <select class="form-control" id="hobies" data-live-search="true" name="hobies[]" autocomplete="company" value="{{ old('hobies') }}"   autofocus  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please select an element from the list')" title="Please select an element from the list"  multiple >
                                                                        <option value="" selected>None </option>
                                                                             @foreach ($hobies as $hobie)
                                                                            <option value="{{ $hobie->id}}">{{ $hobie->name }} </option>
                                                                            @endforeach 
                                                                        </select>
                                                                        @error('Hobies')
                                                                            <span class=" text-danger invalid-feedback" role="alert" >
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="balance">{{ __("Years Of Experience") }}</label> <!--<span style="color:red">*</span>-->
                                                                        <div class="input-group" style="width:100%;">
                                                                        <input type="number" min="0"  max="60" step="1" id="NombreDanneesDexperience" name="NombreDanneesDexperience" class="form-control" value="{{ old('NombreDanneesDexperience') }}"  title="Balance must contain at least 0.5 as value">
                                                                    </div>
                                                                    @error('NombreDanneesDexperience')
                                                                        <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="balance1">{{ __('Salary Assumption') }}</label> <!--<span style="color:red">*</span>-->
                                                                        <div class="input-group" style="width:100%;">
                                                                        <input type="number" min="0"  max="15000" step="500" id="PretentionSalariale" name="PretentionSalariale" class="form-control" value="{{ old('PretentionSalariale') }}"  title="Balance must contain at least 0.5 as value" >
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
                                                                            <input type="text" class="form-control" name="Nom" id="Nom"  value="{{ old('First Name') }}" title="" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required">
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
                                                                            <input type="text" class="form-control" name="Prenom" id="Prenom"  value="{{ old('Prenom') }}"  title="" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required">
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
                                                                        <option value="" selected>None </option>
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
                                                                            <input type="tel" class="form-control" id="phone"  name="phone" value="{{ old('phone') }}"  title="Phone number must contain 10 digits" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);" size="10" maxlength="10"  required="required">
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
                                                                           <input  type="date" class="form-control" id="DateNaissance" name="DateNaissance" value="{{ old('DateNaissance') }}" autocomplete="off" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" title="">

                                                                        </div>
                                                                        @error('DateNaissance')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="EnArretDepuis">{{ __('Stopped Since') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                            <input  type="date" class="form-control" id="EnArretDepuis" name="EnArretDepuis" value="{{ old('EnArretDepuis') }}" autocomplete="off" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" title="">
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
                                                                            <input type="text" class="form-control" name="CIN" id="cin" value="{{ old('CIN') }}" >
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
                                                                            <div class="input-group-addon"><i class="fa fa-plus-square"></i></div>
                                                                            <input type="file" class="form-control" name="CV" id="CV"  value="CV" >
                                                                        </div>
                                                                        @error('CV')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="LettreMotivation">{{ __('Cover Letter') }}</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-plus-square"></i></div>
                                                                            <input type="file" class="form-control" name="LettreMotivation" id="LettreMotivation"  value="LettreMotivation"  enctype="multipart/form-data">
                                                                        </div>
                                                                        @error('LettreMotivation')
                                                                            <span class="text-danger invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                            <label class="control-label mb-10 text-left">{{ __('Adress') }}</label>
                                                                            <textarea class="form-control" id="Adresse" name="Adresse" rows="5">{{ old('Adresse') }}</textarea>
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
                                    <button type="submit" class="btn btn-success mr-15 mb-30" style="background: #333652;border: solid 1px #333652; margin-right: 15px;float: right;">{{ __('Create candidat') }}</button>
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
