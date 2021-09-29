@extends('layouts.app')

@section('content')
<div class="page-wrapper">
		<div class="container-fluid">
				<div class="row">
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
                                                    <span>{{ __('Users list') }}</span>
                                                </a>
                                            </li>
                                            <li class="create">
                                                <a href="/admin/users/create"><button class= "creation btn btn-success btn-block btn btn-rounded btn-success" style="background:#333652; border:solid 1px #333652;width:200px;border-radius: 5px;">{{ __('CREATE USER') }}</button></a>
                                            </li>
                                        </ul>
                                        <div class="table-wrap">
                                            <div class=" table-responsive col-sm-12 col-xs-12">
                                                <table class="table mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Full Name') }}</th>
                                                        <th>{{ __('Role') }}</th>
                                                        <th>{{ __('Company') }}</th>
                                                        <th>{{ __('Balance') }}</th>
                                                        <th>{{ __('Address') }}</th>
                                                        <th>{{ __('Phone Number') }}</th>
                                                        <th>{{ __('E-Mail') }}</th>
                                                        <th>{{__('Actions')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $i = 2; @endphp
                                                    @foreach ($users as $user)
                                                        @if($i % 2 == 0)
                                                            <tr role="row" class="odd">
                                                        @else
                                                            <tr role="row" class="even">
                                                                @endif
                                                                @php $i++; @endphp

                                                                <td class="sorting_1">{{$user->firstname}} {{$user->lastname}}</td>
                                                                <td>
                                                                    @if ($user->admin == 1)
                                                                        <span class="label label-danger">{{ __('Administrator') }}</span>
                                                                    @else
                                                                        <span class="label label-success" style="background:#19aef5;">{{ __('Collaborater') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td> {{$user->company->name}}</td>
                                                                <td>{{$user->balance}}</td>
                                                                <td>{{$user->address}}</td>
                                                                <td style="white-space: nowrap;">{{$user->tel}}</td>
                                                                <td>{{$user->email}}</td>
                                                                <td>
                                                                    <div style="white-space: nowrap;">
                                                                        @if($user->id == $id)
                                                                            <a href="/admin/users/edit/{{$user->id}}" class="mr-25" data-toggle="tooltip" data-original-title="{{ __('Edit') }}"> <i class="fa fa-pencil text-warning text-inverse m-r-10"></i> </a>
                                                                        @else
                                                                            <a href="/admin/users/edit/{{$user->id}}" class="mr-25" data-toggle="tooltip" data-original-title="{{ __('Edit') }}"> <i class="fa fa-pencil text-warning text-inverse m-r-10"></i> </a>
                                                                            <input type="checkbox" id="{{$user->id}}" class="js-switch js-switch-1" data-color="#ff2a00" onchange="enadisble(this.id, {{$user->id}});"  {{ $user->statut == 1 ? 'checked' : 'false'}} />
                                                                            <a href="/admin/users/reset-password/{{$user->id}}" data-toggle="tooltip" data-original-title="{{ __('Reset Password') }}"> <i class="fa fa-history text-primary"></i></a>

                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                    </tbody>
                                                </table>

                                                <div id="logs_page_footer">
                                                    <nav aria-label="...">
                                                        <ul class="pagination  mb-0">
                                                            @if(!$users-> isEmpty())
                                                                <li class="page-item @if ($users->onFirstPage()) disabled @endif">
                                                                    <a class="page-link first" href="{{ $users->previousPageUrl() }}" tabindex="-1">
                                                                        <i class="fa fa-chevron-left"></i>
                                                                        <span class="sr-only">Previous</span>
                                                                    </a>
                                                                </li>
                                                                @if($users->currentPage() == $users->lastPage()-1 && $users->lastPage()-1>1)
                                                                    <li class="page-item">
                                                                        <a class="page-link second"
                                                                           href="{{ $users->url($users->currentPage()-1) }}">{{ $users->currentPage()-1 }}</a>
                                                                    </li>
                                                                @elseif($users->currentPage() == $users->lastPage() && $users->lastPage()-1>1)
                                                                    <li class="page-item">
                                                                        <a class="page-link second"
                                                                           href="{{ $users->url($users->currentPage()-2) }}">{{ $users->currentPage()-2 }}</a>
                                                                    </li>
                                                                    <li class="page-item">
                                                                        <a class="page-link second"
                                                                           href="{{ $users->url($users->currentPage()-1) }}">{{ $users->currentPage()-1 }}</a>
                                                                    </li>
                                                                @endif
                                                                @foreach($users->getUrlRange($users->currentPage(),$users->currentPage()+2) as $page => $url)
                                                                    @if($page <= $users->lastPage())
                                                                        <li class="page-item second @if($users->currentPage()== $page) active @endif">
                                                                            <a class="page-link "
                                                                               href="{{ $url }}">{{ $page }}</a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                                <li class="page-item   @if (!$users->hasMorePages()) disabled @endif">
                                                                    <a class="page-link first" href="{{ $users->nextPageUrl() }}">
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


@endsection
