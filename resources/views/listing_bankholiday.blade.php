@extends('layouts.app')

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formu" action="" method="GET">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Holiday name:</label>
                            <input type="text" class="form-control" id="holiday-name" name="holiday_name">
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Start day:</label>
                                <input  type="date" class="form-control" id="start" name="start_date" value=""  autocomplete="off" onchange="cal()">
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">End day:</label>
                                <input type="date" class="form-control" id="end" name="end_date" value=""  autocomplete="off" onchange="cal()">
                        </div>

                        <div class="form-group">
                            <label  class="col-form-label">Bank holiday type:</label>
                                <select class="form-control" id="type" name="type_id" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('This field id required')" required>
                                    <option class="option" value=""></option>
                                    @foreach($types as $type )
                                        <option class="option" value="{!! $type->id !!}">{!! $type->type !!}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label  class="col-form-label">Bank holiday year:</label>
                            <select class="form-control" id="year" name="year_id" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('This field id required')" required>
                                <option class="option" value=""></option>
                                @foreach($year as $years )
                                    <option class="option" value="{!! $years->id !!}">{!! $years->year !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn" id="save">Save</button>
                            <button type="button" class="btn" data-dismiss="modal" id="delete">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="container-fluid pt-25">
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
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div  class="panel-body pb-0">
                                <div  class="tab-struct custom-tab-1">
                                    <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                                        <li class="active" role="presentation">
                                            <a class="underline" data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false">
                                                <span>{{ __('Bank days listing') }}</span>
                                            </a>
                                        </li>
                                        <li class="create">
                                            <a href="/bank_holidays"><button class= "creation btn btn-success btn-block btn btn-rounded btn-success" style="background:#333652; border:solid 1px #333652;width:200px;border-radius: 5px;">{{ __('CREATE BANKDAY') }}</button></a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent_8">
                                        <div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                        <div class="panel-wrapper collapse in">
                                                            <div class="panel-body pa-0">
                                                                <div class="row justify-content-end">
                                                                    <div class="col-lg-3 filtre">
                                                                        <select onchange="typeChanged(this.value,{{$id}}) " class="form-control mb-20" id="type" name="type" autofocus>
                                                                            <option value="" >Filter by holiday type</option>
                                                                            <option value="all" >Display all</option>

                                                                        @foreach ($types as $type)
                                                                                <option value="{{ $type->id }}" >{{ $type->type }} </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="table-responsive col-sm-12 col-xs-12">
                                                                    <table class="table mb-0">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>{{ __('Bank holiday name') }}</th>
                                                                            <th>{{ __('Start date') }}</th>
                                                                            <th>{{ __('End date') }}</th>
                                                                            <th>{{ __('Bank holiday type') }}</th>
                                                                            <th>{{ __('Bank holiday year') }}</th>
                                                                            @if(Auth::user()->hasRole('admin'))
                                                                                <th>{{ __('Actions') }}</th>
                                                                                @endif
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($bankdays as $bankday)
                                                                                <tr  class="mestds" data-bankid="{{$bankday->id}}">
                                                                                    <td class="bankid" >{{$bankday->id}}</td>
                                                                                    <td class="bankname">{{$bankday->holiday_name}}</td>
                                                                                    <td class="bankstart">{{$bankday->start_date}}</td>
                                                                                    <td class="bankend">{{$bankday->end_date}}</td>
                                                                                    @foreach($types as $type )
                                                                                        @if($type->id ==$bankday->type_id )
                                                                                            <td class="banktype" value="{{$type->id}}">
                                                                                               {{$type->type}}
                                                                                            </td>
                                                                                        @endif
                                                                                    @endforeach
                                                                                        @foreach($holyears as $holyear)
                                                                                            @if($holyear->holiday_id ==$bankday->id )
                                                                                                @foreach($year as $years )
                                                                                                    @if($years->id==$holyear->year_id )
                                                                                                        <td  value="{{$years->year}}">
                                                                                                            {{$years->year}}
                                                                                                        </td>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @if(Auth::user()->hasRole('admin'))
                                                                                        <td>
                                                                                            <button  class="btn trash btn-github btn-icon-anim btn-square modal-btn" onclick="suppr({{$bankday->id}} , {{$holyear->year_id}})"  ><i class="fa fa-trash-o"></i></button>
                                                                                            <button  class="btn edit btn-github btn-icon-anim btn-square modal-btn" onclick="showmodal({{$bankday->id}})"><i class="fa fa-edit"></i></button>
                                                                                        </td>
                                                                                    @endif
                                                                                    </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                    <div id="logs_page_footer">
                                                                        <nav aria-label="...">
                                                                            <ul class="pagination  mb-0">
                                                                                @if(!$bankdays-> isEmpty())
                                                                                    <li class="page-item @if ($bankdays->onFirstPage()) disabled @endif">
                                                                                        <a class="page-link first" href="{{ $bankdays->previousPageUrl() }}" tabindex="-1">
                                                                                            <i class="fa fa-chevron-left"></i>
                                                                                            <span class="sr-only">Previous</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    @if($bankdays->currentPage() == $bankdays->lastPage()-1 && $bankdays->lastPage()-1>1)
                                                                                        <li class="page-item">
                                                                                            <a class="page-link second"
                                                                                               href="{{ $bankdays->url($bankdays->currentPage()-1) }}">{{ $bankdays->currentPage()-1 }}</a>
                                                                                        </li>
                                                                                    @elseif($bankdays->currentPage() == $bankdays->lastPage() && $bankdays->lastPage()-1>1)
                                                                                        <li class="page-item">
                                                                                            <a class="page-link second"
                                                                                               href="{{ $bankdays->url($bankdays->currentPage()-2) }}">{{ $bankdays->currentPage()-2 }}</a>
                                                                                        </li>
                                                                                        <li class="page-item">
                                                                                            <a class="page-link second"
                                                                                               href="{{ $bankdays->url($bankdays->currentPage()-1) }}">{{ $bankdays->currentPage()-1 }}</a>
                                                                                        </li>
                                                                                    @endif
                                                                                    @foreach($bankdays->getUrlRange($bankdays->currentPage(),$bankdays->currentPage()+2) as $page => $url)
                                                                                        @if($page <= $bankdays->lastPage())
                                                                                            <li class="page-item second @if($bankdays->currentPage()== $page) active @endif">
                                                                                                <a class="page-link "
                                                                                                   href="{{ $url }}">{{ $page }}</a>
                                                                                            </li>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    <li class="page-item   @if (!$bankdays->hasMorePages()) disabled @endif">
                                                                                        <a class="page-link first" href="{{ $bankdays->nextPageUrl() }}">
                                                                                            <i class="fa fa-chevron-right"></i>
                                                                                            <span class="sr-only">Next</span>
                                                                                        </a>
                                                                                    </li>
                                                                                @endif
                                                                            </ul>
                                                                        </nav>
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

    <script>
        function showmodal(id) {

                @foreach ($bankdays as $bankday){
                if ({!! json_encode($bankday->id)!!} == id)
                {
                    var action=document.getElementById('formu');
                    action.setAttribute("action","{{ URL('/bank_holidays/update/'.$bankday->id )}}");
                    $('#exampleModalLabel').html("{!! ($bankday->holiday_name) !!}");
                    $('#holiday-name').val("{!! ($bankday->holiday_name)!!}");
                    $('#start').val("{!! ($bankday->start_date)!!}");
                    $('#end').val("{!! ($bankday->end_date)!!}");
                    $('#type').val({!! ($bankday->type_id)!!});
                        @foreach($holyears as $holyear) {
                        if("{{$holyear->holiday_id}}"=="{{$bankday->id}}")
                        {
                            $('#year').val({!! ($holyear->year_id)!!});
                        }
                    }
                    @endforeach;
                }
            };
            @endforeach
            $('#exampleModal').modal();
        }
        function typeChanged(type, year) {
            window.location='/bank_holidays/annees/listing/filtreType/'+type+'/'+year;

        }
    </script>

@endsection
