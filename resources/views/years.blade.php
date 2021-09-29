@extends('layouts.app')

@section('content')

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
                                        <li class="active" role="presentation"><a  class="underline" data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>{{ __('Years listing') }}</span></a></li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent_8">
                                        <div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                    <div class="">
                                                        <div class="panel-wrapper collapse in">
                                                            <div class="panel-body pa-0">
                                                                <div class=" table-responsive col-sm-12 col-xs-12">
                                                                    <table class="table mb-0">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>{{ __('Year') }}</th>
                                                                            <th>{{ __('Actions') }}</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        @foreach ($years as $year)
                                                                            <tr>
                                                                                <td >{{$year->id}}</td>
                                                                                <td >{{$year->year}}</td>
                                                                                    <td>
                                                                                        <button class=" eye btn btn-github btn-icon-anim btn-square modal-btn" onclick="window.location.href='{{ '/bank_holidays/annees/listing/'. $year->id }}'"><i class="fa fa-eye"></i></button>
                                                                                    </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                    <div id="logs_page_footer">
                                                                        <nav aria-label="...">
                                                                            <ul class="pagination  mb-0">
                                                                                @if(!$years-> isEmpty())
                                                                                    <li class="page-item @if ($years->onFirstPage()) disabled @endif">
                                                                                        <a class="page-link first" href="{{ $years->previousPageUrl() }}" tabindex="-1">
                                                                                            <i class="fa fa-chevron-left"></i>
                                                                                            <span class="sr-only">Previous</span>
                                                                                        </a>
                                                                                    </li>
                                                                                    @if($years->currentPage() == $years->lastPage()-1 && $years->lastPage()-1>1)
                                                                                        <li class="page-item">
                                                                                            <a class="page-link second"
                                                                                               href="{{ $years->url($years->currentPage()-1) }}">{{ $years->currentPage()-1 }}</a>
                                                                                        </li>
                                                                                    @elseif($years->currentPage() == $years->lastPage() && $years->lastPage()-1>1)
                                                                                        <li class="page-item">
                                                                                            <a class="page-link second"
                                                                                               href="{{ $years->url($years->currentPage()-2) }}">{{ $years->currentPage()-2 }}</a>
                                                                                        </li>
                                                                                        <li class="page-item">
                                                                                            <a class="page-link second"
                                                                                               href="{{ $years->url($years->currentPage()-1) }}">{{ $years->currentPage()-1 }}</a>
                                                                                        </li>
                                                                                    @endif
                                                                                    @foreach($years->getUrlRange($years->currentPage(),$years->currentPage()+2) as $page => $url)
                                                                                        @if($page <= $years->lastPage())
                                                                                            <li class="page-item second @if($years->currentPage()== $page) active @endif">
                                                                                                <a class="page-link "
                                                                                                   href="{{ $url }}">{{ $page }}</a>
                                                                                            </li>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    <li class="page-item   @if (!$years->hasMorePages()) disabled @endif">
                                                                                        <a class="page-link first" href="{{ $years->nextPageUrl() }}">
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
    </div>
    <!-- /Row -->
@endsection
