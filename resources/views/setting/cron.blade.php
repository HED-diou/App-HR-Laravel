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
                                        <li class="active" role="presentation"><a  class="underline" data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>{{ __('Balance update') }}</span></a></li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent_8">
                                        <div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="">
                                                        <div class="panel-wrapper collapse in">
                                                            <div class="panel-body pa-0">
                                                                <div class="col-sm-12 col-xs-12">
                                                                    <div class="form-wrap">
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
                                                                        <form action="{{ route('setting.cron_update') }}" method="POST">
                                                                            @csrf
                                                                                <div class="form-group">
                                                                                    <label class="control-label mb-10" for="date_execution">{{ __('Execution date') }}</label>  <span style="color:red">*</span>
                                                                                    <input type="date" class="form-control" name="date_execution"  id="date_execution"  oninvalid="InvalidMssg(this);" oninput="InvalidMssg(this);" required>
                                                                                </div>
                                                                            @error('date_execution')
                                                                                 <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                                <div class="form-actions text-right mt-10">
                                                                                    <button type="submit" class="btn btn-success  mb-30" style="background-color: #114a8f; border-color:#114a8f">{{ __('Submit') }}</button>
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
        </div>
    </div>
    <!-- /Row -->
@endsection
