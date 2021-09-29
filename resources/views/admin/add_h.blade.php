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
                            <li class="active" role="presentation"><a  class="underline" data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>{{ __('Hobie') }}</span></a></li>
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
                                                            <form action="{{ route('admin.store_H') }}" name="myForm" method="POST" autocomplete="off">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label class="control-label mb-10" for="Hobie">{{ __('Hobie') }}</label> <span style="color:red">*</span>
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fas fa-laptop-code"></i></div>
                                                                        <input type="text" oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);"  required="required" class="form-control"  id="Hobie" name="Hobie" placeholder="Hobie name" value="{{ old('Hobie') }}" autocomplete="Hobie" autofocus>

                                                                    </div>
                                                                    @error('technologie')
                                                                        <span class="text-danger invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <button type="submit" class="btn btn-success mr-15 mb-30" style="background: #333652;border: solid 1px #333652; margin-right: 15px;float: right;">{{ __('Add this Hobie') }}</button>
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
