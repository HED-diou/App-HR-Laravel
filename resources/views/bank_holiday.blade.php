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
                                        <li class="active" role="presentation"><a  class="underline" data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>{{ __('CREATE A NEW BANK DAY') }}</span></a></li>
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
                                                                        <form action="{{ route('bank.store') }}" method="POST">
                                                                            @csrf
                                                                            <form class="form-body overflow-hide">
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
                                                                                    <label class="control-label mb-10" for="firstname">{{ __('Bank holiday') }}</label>
                                                                                    <div class="input-group">
                                                                                        <input type="text" class="form-control" name="holiday_name" id="bankday"  value=""  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('This field id required')" required >
                                                                                        <div class="input-group-addon"><i class="fa fa-thumb-tack"></i></div>
                                                                                    </div>
                                                                                </div>
                                                                                    @error('holiday_name')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                         <strong>
                                                                                                 {{ $message }}
                                                                                         </strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <div class="form-group">
                                                                                    <label class="control-label mb-10" for="startdate">{{ __('Start date') }}</label>
                                                                                        <input type="date" class="form-control" name="start_date"  id="startdate" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('This field id required')" required >
                                                                                </div>
                                                                                    @error('start_date')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                         <strong>
                                                                                                 {{ $message }}
                                                                                         </strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <div class="form-group">
                                                                                        <label class="control-label mb-10" for="enddate">{{ __('End date') }}</label>
                                                                                        <input type="date"  class="form-control" id="endday" name="end_date"  pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('This field id required')" required>
                                                                                  </div>
                                                                                    @error('end_date')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                         <strong>
                                                                                                 {{ $message }}
                                                                                         </strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                <div class="form-group mt-30 mb-30">
                                                                                    <label class="control-label mb-10 text-left">{{ __('Years') }}</label>
                                                                                    <select class="form-control" id="year" name="year_id" autofocus>
                                                                                        @foreach ($year as $years)
                                                                                            <option value="{{ $years->id}}" >{{ $years->year }} </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                    @error('year_id')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                         <strong>
                                                                                                 {{ $message }}
                                                                                         </strong>
                                                                                        </span>
                                                                                    @enderror
                                                                                    <div class="form-group mt-30 mb-30">
                                                                                        <label class="control-label mb-10 text-left">{{ __('Types') }}</label>
                                                                                        <select class="form-control" id="type" name="type_id" autofocus>
                                                                                            @foreach ($types as $type)
                                                                                                <option value="{{ $type->id}}" >{{ $type->type }} </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    @error('type_id')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                         <strong>
                                                                                                 {{ $message }}
                                                                                         </strong>
                                                                                        </span>
                                                                                    @enderror
                                                                            <div class="form-actions text-right mt-10">
                                                                                <button type="submit" class="btn btn-success  mb-30" style="background-color: #114a8f; border-color:#114a8f">{{ __('Create Bankday') }}</button>
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
