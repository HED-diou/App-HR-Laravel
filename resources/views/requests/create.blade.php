@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid pt-25">


    <div class="col-lg-9 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div  class="panel-body pb-0">
                    <div  class="tab-struct custom-tab-1">
                        <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                            <li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false" style=" border-bottom: 3px solid #333652;"><span>{{ __('CREATE REQUEST') }}</span></a></li>

                        </ul>
                        <div class="tab-content" id="myTabContent_8">
                            <div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
                            <div class="row">
                                    <div class="col-lg-12">
                                        <div class="">
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body pa-0">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="form-wrap">
                                                            <form id="requestform" action="{{ route('requests.store') }}" method="POST">
                                                             @csrf
                                                                <div class="form-body overflow-hide">
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

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="start_date">{{ __('Start Date') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                           <input  class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}"  autocomplete="off" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required">

                                                                        </div>
                                                                        <div class="checkbox checkbox-succes">
                                                                                <input id="leaving_at_evening2" name="leaving_at_evening" value="0" type="hidden">
                                                                                <input id="leaving_at_evening" name="leaving_at_evening" value="1" type="checkbox"  {{ old('leaving_at_evening') == 1 ? 'checked' : 'false'}}>
                                                                                <label for="leaving_at_evening">
                                                                                {{ __('Leaving at evening') }}
                                                                                </label>
                                                                        </div>
                                                                        </div>
                                                                        @error('start_date')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="end_date">{{ __('End Date') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                           <input class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" autocomplete="off" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required"  >

                                                                        </div>
                                                                        <div class="checkbox checkbox-succes">
                                                                                <input id="coming_at_evening2" name="coming_at_evening" value="0" type="hidden">
                                                                                <input id="coming_at_evening" name="coming_at_evening" value="1" type="checkbox"  {{ old('coming_at_evening') == 1 ? 'checked' : 'false'}}>
                                                                                <label for="coming_at_evening">
                                                                                {{ __('Coming at evening') }}
                                                                                </label>
                                                                        </div>

                                                                        @error('end_date')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10" for="dayscount">{{ __('Days count') }}</label> <span style="color:red">*</span>
                                                                        <div class="input-group" style="width:100%;">
                                                                        <input type="number" min="0.5"  max="30" step="0.5" id="dayscount" name="dayscount" class="form-control" value="{{ old('dayscount') }}" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required"   />
                                                                    </div>
                                                                    @error('dayscount')
                                                                        <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    </div>

                                                                    <div class="form-group mt-30 mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Holiday Type') }}</label> <span style="color:red">*</span>
                                                                        <select class="form-control" id="holidaytype" name="holidaytype" required  oninvalid="this.setCustomValidity('Please select a holiday type from the list')" oninput="this.setCustomValidity('')"/>
                                                                             <option value="" selected>None </option>
                                                                            @foreach ($holidays as $holiday)
                                                                            <option value="{{ $holiday->id}}" {{ old('holidaytype') == $holiday->id ? 'selected' : ''}}>{{ $holiday->type }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('holidaytype')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                            <label class="control-label mb-10 text-left">{{ __('Comment') }}</label>
                                                                            <textarea class="form-control" id="comment" name="comment" rows="2">{{ old('comment') }}</textarea>
                                                                            @error('comment')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 " style="padding:0px;">
                                                                    <button type="submit" class="btn btn-success mb-30" style="background:#333652; border:solid 1px #333652;float: right;">{{ __('Create Request') }}</button>
                                                                    <a href="{{ route('admin.users') }}"><button  type="button" class="btn edit btn-github btn-icon-anim btn-square modal-btn" title="{{ __('Back') }}"><i class="fa fa-arrow-circle-left" ></i></button></a>
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
            </div>
        </div>


    </div>

    </div>

</div>
<!-- /Row -->

@endsection
