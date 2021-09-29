@extends('layouts.app')

@section('content')
<div class="page-wrapper some-page-class">
    <div class="container-fluid pt-25">


    <div class="col-lg-9 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div  class="panel-body pb-0">
                    <div  class="tab-struct custom-tab-1">
                        <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                            <li class="active" role="presentation"><a class="underline" data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>{{ __('EDIT REQUEST') }}</span></a></li>

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
                                                            <form action="/requests/update/{{$requests->request_id}}" id="myform" method="POST" onchange="check_change();">
                                                             @csrf
                                                             <input id="ownership" type="hidden" value="{{ $ownership }}">
                                                             <input id="statuts" type="hidden" value="{{ $requests->statut }}">
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
                                                                        <label class="control-label mb-10" for="start_date">{{ __('Start Date') }}</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                           <input  class="form-control" id="start_date" name="start_date" value="{{ $requests->start_date }}"   autocomplete="off">

                                                                        </div>
                                                                        <div class="checkbox checkbox-succes">
                                                                                <input id="leaving_at_evening2" name="leaving_at_evening" value="0" type="hidden">
                                                                                <input id="leaving_at_evening" name="leaving_at_evening" value="1" type="checkbox"  {{ $requests->leaving_at_evening == 1 ? 'checked' : 'false'}} onchange="cal()">
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
                                                                        <label class="control-label mb-10" for="end_date">{{ __('End Date') }}</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                                           <input  class="form-control" id="end_date" name="end_date" value="{{ $requests->end_date }}" autocomplete="off">

                                                                        </div>
                                                                        <div class="checkbox checkbox-succes">
                                                                                <input id="coming_at_evening2" name="coming_at_evening" value="0" type="hidden">
                                                                                <input id="coming_at_evening" name="coming_at_evening" value="1" type="checkbox"  {{ $requests->coming_at_evening == 1 ? 'checked' : 'false'}} onchange="cal()">
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
                                                                        <label class="control-label mb-10" for="dayscount">{{ __('Days count') }}</label>
                                                                        <div class="input-group" style="width:100%;">
                                                                        <input type="number" min="0.5"  max="30" step="0.5" id="dayscount" name="dayscount" class="form-control" value="{{ $requests->dayscount }}">
                                                                    </div>
                                                                    @error('dayscount')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                    </div>

                                                                    <div class="form-group mt-30 mb-30">
                                                                        <label class="control-label mb-10 text-left">{{ __('Holiday Type') }}</label>
                                                                        <select class="form-control" id="holidaytype" name="holidaytype">
                                                                        <option value="" selected>None </option>
                                                                            @foreach ($holidays as $holiday)
                                                                            <option value="{{ $holiday->id}}" {{ $requests->holidaytype == $holiday->id ? 'selected' : ''}}>{{ $holiday->type }}</option>
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
                                                                            <textarea class="form-control" id="comment" name="comment" rows="2" onkeyup="check_change();">@if(Auth::user()->hasRole('admin')){{ $requests->comment }}@endif</textarea>
                                                                            @error('comment')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>


                                                                    <div class="form-group">
                                                                            <label class="control-label mb-10 text-left">{{ __('Admin Comment') }}</label>
                                                                            <textarea class="form-control" id="admincomment" name="admincomment" rows="2" onkeyup="check_change();" {{ !Auth::user()->hasRole('admin') ? 'readonly' : 'true'}}>@if(!Auth::user()->hasRole('admin')){{ $requests->admincomment }}@endif</textarea>
                                                                            @error('admincomment')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>








                                                                </div>
                                                                <div class="form-actions mt-10" style="padding:0px;">
                                                                <a href="{{ route('requests') }}"><button  type="button" class="btn edit btn-github btn-icon-anim btn-square modal-btn mr-10 mb-30" title="{{ __('Back') }}"><i class="fa fa-arrow-circle-left" ></i></button></a>
                                                                    @if ($ownership == 1 && $requests->statut != 5)
                                                                        <button type="submit" class="btn btn-success mr-10 mb-30" id="update_button" disabled="true" value="/requests/update/{{$requests->request_id}}" onclick="actionform(this.id);">{{ __('Update Request') }}</button>
                                                                        @if($requests->statut == 2 || $requests->statut == 1)
                                                                        <button  id="cancel_button" type="submit" class="btn btn-danger btn-icon-anim btn-square modal-btn mr-10 mb-30" value="/requests/cancel/{{$requests->request_id}}" title="{{ __('Cancel') }}" onclick="actionform(this.id);"><i class="fa fa-ban"></i></button>
                                                                        @endif
                                                                    @endif
                                                                    @if(Auth::user()->hasRole('admin'))
                                                                        @if($requests->statut != 5)
                                                                        <button  id="archive_button" type="submit" class="btn btn-default btn-icon-anim btn-square modal-btn mr-10 mb-30" value="/requests/archive/{{$requests->request_id}}" title="{{ __('Archive') }}" onclick="actionform(this.id);" style="float: right;"><i class="fa fa-lock"></i></button>
                                                                        @else
                                                                        <button  id="unarchive_button" type="submit" class="btn btn-default btn-icon-anim btn-square modal-btn mr-10 mb-30" value="/requests/unarchive/{{$requests->request_id}}" title="{{ __('Unarchive') }}" onclick="actionform(this.id);" style="float: right;"><i class="fa fa-unlock"></i></button>
                                                                        @endif
                                                                        @if($requests->statut == 1)
                                                                        <button  id="refuse_button" type="submit" class="btn btn-danger btn-icon-anim btn-square modal-btn mr-10 mb-30" value="/requests/refuse/{{$requests->request_id}}" title="{{ __('Refuse') }}" onclick="actionform(this.id);" style="float: right;"><i class="fa fa-times-circle" ></i></button>
                                                                        @endif
                                                                        @if ($requests->latest_action == 2)
                                                                        <button  id="validate_cancel_button" type="submit" class="btn btn-danger btn-icon-anim btn-square modal-btn mr-10 mb-30" value="/requests/validate/{{$requests->request_id}}" title="{{ __('Validate the cancellation') }}" onclick="actionform(this.id);" style="float: right;"><i class="fa fa-check-circle-o" ></i></button>
                                                                        @elseif($requests->statut == 1)
                                                                        <button  id="validate_button" type="submit" class="btn btn-success btn-icon-anim btn-square modal-btn mr-10 mb-30" value="/requests/validate/{{$requests->request_id}}" title="{{ __('Validate') }}" onclick="actionform(this.id);" style="float: right;"><i class="fa fa-check-circle-o" ></i></button>
                                                                        @endif
                                                                    @endif
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
            </div>
        </div>


    </div>

</div>
<!-- /Row -->
{!! $ownership !!}
<script>
    window.onload = function() {
        var ownership = {{$ownership}};
        var statut = {{$requests->statut}};


        if( ownership == 0 || statut == 5)
        {
            document.getElementById("start_date").readOnly = true;
            document.getElementById("holidaytype").disabled = true;
            document.getElementById("coming_at_evening").disabled = true;
            document.getElementById("leaving_at_evening").disabled = true;
            document.getElementById("comment").readOnly = true;
            document.getElementById("end_date").readOnly = true;




        }

        if(statut !=1)
        {
            document.getElementById("dayscount").readOnly = true;
        }
        if(ownership == 1 && statut != 5)
        {
            document.getElementById("dayscount").readOnly = false;
        }
        if(statut == 2 && statut == 3 && statut == 4)
        {
            document.getElementById("admincomment").readOnly = true;
        }
    };
</script>
@endsection

