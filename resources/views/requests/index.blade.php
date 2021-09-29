@extends('layouts.app')

@section('content')
<div class="modal  fade bs-example-modal-lg"  id="modal-request" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h5 class="modal-title" id="myLargeModalLabel"></h5>
													</div>
													<div class="modal-body">
														<h5 id="usermodal" class="mb-15"></h5>
                                                            <div class="table-wrap mt-40">
                                                            <div class="table-responsive">
                                                                <table class="table mb-0">
                                                                    <thead>
                                                                      <tr>
                                                                        <th>#</th>
                                                                        <th>{{ __('Start Date') }}</th>
                                                                        <th>{{ __('End Date') }}</th>
                                                                        <th>{{ __('Days Count') }}</th>
                                                                        <!-- <th>{{ __('Comment') }}</th> -->
                                                                        <th>{{ __('Latest Action') }}</th>
                                                                        <th>{{ __('Admin Comment') }}</th>
                                                                        <th>{{ __('Statuts') }}</th>
                                                                      </tr>
                                                                    </thead>
                                                                    <tbody id="rows">
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
</div>

<div class="page-wrapper">
		<div class="container-fluid pt-25">
			<div class="row">
					<!-- Basic Table -->
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							@if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><p>{{ $message }}</p>
							</div>
                            @endif
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
                                    <div  class="tab-struct custom-tab-1">
                                        <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                                            <li class="active" role="presentation">
                                                <a class="underline" data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false">
                                                    <span>{{ __('Requests listing') }}</span>
                                                </a>
                                            </li>
                                            <li class="create">
                                                <a href="/requests/create"><button class= "creation btn btn-success btn-block btn btn-rounded btn-success" style="background:#333652; border:solid 1px #333652;width:200px;border-radius: 5px;">{{ __('CREATE REQUEST') }}</button></a>
                                            </li>
                                        </ul>
                                        <div class="table-wrap mt-40">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        @if (Auth::user()->hasRole('admin'))
                                                        <th>{{ __('User') }}</th>
                                                        @endif
                                                        <th>{{ __('Start Date') }}</th>
                                                        <th>{{ __('End Date') }}</th>
                                                        <th>{{ __('Days Count') }}</th>
                                                        <!-- <th>{{ __('Comment') }}</th> -->
                                                        <th>{{ __('Latest Action') }}</th>
                                                        <th>{{ __('Admin Comment') }}</th>
                                                        <th>{{ __('Statuts') }}</th>
                                                        <th>{{ __('Actions') }}</th>
                                                        <th>{{ __('Details') }}</th>

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($requests as $request)
                                                    <tr>

                                                        <td>{{$request->request_id}}
                                                        @if(isset($request->requesterfn) && isset($request->requesterln) && Auth::user()->hasRole('admin'))
                                                        <td>{{$request->requesterfn}} {{$request->requesterln}}</td>
                                                        @endif
                                                        <td>{{$request->start_date}}</td>
                                                        <td>{{$request->end_date}}</td>
                                                        <td>{{$request->dayscount}} days</td>
                                                        <!-- <td>{{$request->comment}}</td> -->
                                                        <td>
                                                        @if ($request->latest_action == NULL )
                                                        <b style="color:green;">{{ __('Created at') }}</b>
                                                        @elseif ($request->latest_action == 1 || $request->latest_action == 3)
                                                        <b style="color:orange;"> {{ __('Updated at') }}</b>
                                                        @elseif($request->latest_action == 2 || $request->latest_action == 6)
                                                        <b style="color:red;">{{ __('Canceled at') }}</b>
                                                        @elseif($request->latest_action == 5)
                                                        <b style="color:red;">{{ __('Refused at') }}</b>
                                                        @elseif($request->latest_action == 7)
                                                        <b style="color:black;">{{ __('Archived at') }}</b>
                                                        @elseif($request->latest_action == 8)
                                                        <b style="color:blue;">{{ __('Unarchived at') }}</b>
                                                        @else
                                                        <b style="color:#01c853;">{{ __('Validated at') }}</b>
                                                        @endif
                                                        {{$request->updated_at}}
                                                        <p style="font-size: 12px;">{{ __('By') }}
                                                        @if($request->admin_id == NULL)
                                                        {{$request->requesterfn}} {{$request->requesterln}}
                                                        @else
                                                        <b style="color:red;">{{$request->adminfn}} {{$request->adminln}}</b>
                                                        @endif
                                                        </p>
                                                        </td>
                                                        <td>{{$request->admincomment}}</td>
                                                        <td><span class="label label-{{$request->label}}">{{$request->name}}</span> </td>
                                                        <td>
                                                                <a href="/requests/edit/{{$request->request_id}}">
                                                                <button  class="btn-consult btn btn-icon-anim btn-square" style="border: solid 1px #454163;" title="{{ __('Consult') }}"><i class="fa fa-cogs"></i></button>
                                                                </a>
                                                        </td>
                                                    <td><button  class="btn btn-default btn-icon-anim btn-square" onclick="modalfunc({{ $request->request_id }}) " style="border: solid 1px #454163;" title="{{ __('History') }}"><i class="fa fa-eye"></i></button></td>
                                                      </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <div id="logs_page_footer">
                                                    <nav aria-label="...">
                                                        <ul class="pagination  mb-0">
                                                                <li class="page-item @if ($requests->onFirstPage()) disabled @endif">
                                                                    <a class="page-link first" href="{{ $requests->previousPageUrl() }}" tabindex="-1">
                                                                        <i class="fa fa-chevron-left"></i>
                                                                        <span class="sr-only">Previous</span>
                                                                    </a>
                                                                </li>
                                                                @if($requests->currentPage() == $requests->lastPage()-1 && $requests->lastPage()-1>1)
                                                                    <li class="page-item">
                                                                        <a class="page-link second"
                                                                           href="{{ $requests->url($requests->currentPage()-1) }}">{{ $requests->currentPage()-1 }}</a>
                                                                    </li>
                                                                @elseif($requests->currentPage() == $requests->lastPage() && $requests->lastPage()-1>1)
                                                                    <li class="page-item">
                                                                        <a class="page-link second"
                                                                           href="{{ $requests->url($requests->currentPage()-2) }}">{{ $requests->currentPage()-2 }}</a>
                                                                    </li>
                                                                    <li class="page-item">
                                                                        <a class="page-link second"
                                                                           href="{{ $requests->url($requests->currentPage()-1) }}">{{ $requests->currentPage()-1 }}</a>
                                                                    </li>
                                                                @endif
                                                                @foreach($requests->getUrlRange($requests->currentPage(),$requests->currentPage()+2) as $page => $url)
                                                                    @if($page <= $requests->lastPage())
                                                                        <li class="page-item second @if($requests->currentPage()== $page) active @endif">
                                                                            <a class="page-link "
                                                                               href="{{ $url }}">{{ $page }}</a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                                <li class="page-item   @if (!$requests->hasMorePages()) disabled @endif">
                                                                    <a class="page-link first" href="{{ $requests->nextPageUrl() }}">
                                                                        <i class="fa fa-chevron-right"></i>
                                                                        <span class="sr-only">Next</span>
                                                                    </a>
                                                                </li>

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
                <!-- /Basic Table -->
			</div>
		</div>
</div>



<script>

  function modalfunc(variable){
	var rows = '';
	@foreach($request_history as $request)
		if({{$request->request_id}}== variable){
			$('#myLargeModalLabel').html( 'Request ID : ' + {!! $request->request_id !!});
			$('#usermodal').html( 'Requester : ' + '{!! $request->requesterfn !!}');
             rows = rows + '<tr><td>{!! $request->request_id !!}</td> <td>{!! $request->start_date !!}</td> <td>{!! $request->end_date !!}</td> <td>{!! $request->dayscount !!}</td>';
			var action = {!!  json_encode($request->latest_action) !!} ;

			if ( action == null )
			{
               rows = rows + '<td><b style="color:green;">{{ __("Created at ") }}</b> {!! $request->updated_at !!}<p style="font-size: 12px;">{{ __("By ") }}';
			}

			else if (action == 1 || action == 3)
			{
				rows = rows + '<td><b style="color:orange;"> {{ __("Updated at") }}</b> {!! $request->updated_at !!}<p style="font-size: 12px;">{{ __("By ") }}';
			}

			else if(action == 2 || action == 6){
				rows = rows + '<td><b style="color:red;">{{ __("Canceled at") }}</b> {!! $request->updated_at !!}<p style="font-size: 12px;">{{ __("By ") }}';
			}

			else if(action == 5){
				rows = rows + '<td><b style="color:red;">{{ __("Refused at") }}</b> {!! $request->updated_at !!}<p style="font-size: 12px;">{{ __("By ") }}';
			}

			else if(action == 7){
                rows = rows + '<td><b style="color:black;">{{ __("Archived at") }}</b> {!! $request->updated_at !!}<p style="font-size: 12px;">{{ __("By ") }}';
			}

			else if(action == 8){
                rows = rows + '<td><b style="color:blue;">{{ __("Unarchived at") }}</b> {!! $request->updated_at !!}<p style="font-size: 12px;">{{ __("By ") }}';
			}

			else {
				rows = rows + '<td><b style="color:#01c853;">{{ __("Validated at") }}</b> {!! $request->updated_at !!}<p style="font-size: 12px;">{{ __("By ") }}';
			}

			var admin = {!!  json_encode($request->admin_id) !!} ;


			if ( admin == null )
			{
				rows = rows + '{!! $request->requesterfn !!} {!! $request->requesterln !!}</p>' ;
			}

			else
			{
				rows = rows + '<b style="color:red;"> {{$request->adminfn}} {{$request->adminln}}</b></p>';
			}

			rows = rows + '</td>' ;
			rows = rows + '<td>{{$request->admincomment}}</td> <td><span class="label label-{{$request->label}}">{{$request->name}}</span> </td> </tr>';




			$('#rows').html(rows);
		}
	@endforeach

	 $('#modal-request').modal();

}
  </script>
@endsection
