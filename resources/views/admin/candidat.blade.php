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
                                                    <span>{{ __('Candidat list') }}</span>
                                                </a>
                                            </li>
                                            <li class="create">
                                                <a href="/admin/candidat/create"><button class= "creation btn btn-success btn-block btn btn-rounded btn-success" style="background:#333652; border:solid 1px #333652;width:200px;border-radius: 5px;">{{ __('CREATE CANDIDAT') }}</button></a>
                                            </li>
                                            <li>
                                                <form action="{{route('candidat.search')}}">
                                                    @csrf
                                                    <input type="text" value="{{old('nom')}}" placeholder="first name, Last Name, CIN" class="form-control" name='nom'>
                                            </li>
                                            <li>
                                                    <select class="form-control" id="Appreciation" name="Appreciation" >
                                                        <option value="0" selected>  </option>
                                                        {{-- <option value="2" selected> In Progress </option> --}}
                                                            @foreach ($appreciations as $appreciation)
                                                            <option value="{{ $appreciation->id}}">{{ $appreciation->name}} </option>
                                                            @endforeach
                                                        </select>
                                            </li>
                                            <li>
                                                    <select class="form-control" id="Appreciation" name="Sexe" >
                                                            <option value="-1"> </option>
                                                            <option value="1">Men </option>
                                                            <option value="0">Women </option>
                                                        </select>
                                            </li>
                                            <li>
                                                    <select class="form-control" id="Appreciation" name="technologie" >
                                                        <option value=""> </option>
                                                            @foreach ($technologies as $technologie)
                                                            <option value="{{ $technologie->id}}">{{ $technologie->name}} </option>
                                                            @endforeach
                                                        </select>
                                            </li>
                                            <li>
                                                    <select class="form-control" id="Appreciation" name="Ville" >
                                                        <option value="">  </option>
                                                            @foreach ($Villes as $Ville)
                                                            <option value="{{ $Ville->name}}">{{ $Ville->name}} </option>
                                                            @endforeach
                                                        </select>
                                            </li>
                                            <li>
                                                    <input type="number" min="0"  max="60" step="1" id="NombreDanneesDexperience" name="NombreDanneesDexperience" class="form-control" value="{{ old('NombreDanneesDexperience') }}"  title="Balance must contain at least 0.5 as value">  
                                            </li>
                                            <li>
                                                    <input type="radio" name="Pattern" id="travaille" value="2"> traineeship <br>
                                                    <input type="radio" name="Pattern" id="travaille" value="1"> employment <br></li><li>
                                                    <button type="submit" class="underline creation btn btn-success btn-block btn btn-rounded btn-success">Apply the filter</button>
                                                </li></form>
                                            
                                        </ul>
                                        <div class="table-wrap">
                                            <div class=" table-responsive col-sm-12 col-xs-12">
                                                <table class="table mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Full Name') }}</th>
                                                        <th>{{ __('Pattern') }}</th>
                                                        <th>{{ __('City') }}</th>
                                                        <th>{{ __('Sexe') }}</th>
                                                        <th>{{ __('APPRECIATION') }}</th>
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

                                                                <td class="sorting_1">{{$user->Nom}} {{$user->Prenom}}</td>
                                                                <td>
                                                                    @if ($user->motife == 1)
                                                                        <span class="label label-danger">{{ __('employment') }}</span>
                                                                    @else
                                                                        <span class="label label-success" style="background:#19aef5;">{{ __('traineeship') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>{{$user->Ville}}</td>
                                                                <td>
                                                                    @if ($user->Sexe == 1)
                                                                        <span class="label label-danger">{{ __('Men') }}</span>
                                                                    @else
                                                                        <span class="label label-success" style="background:#19aef5;">{{ __('Women') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($user->Appreciation == 0)
                                                                        <span class="label label-danger">{{ __('agree') }}</span>
                                                                    @endif 
                                                                    @if($user->Appreciation == 1)
                                                                        <span class="label label-danger " style="background:green;">{{ __('In progress 
                                                                            ') }}</span>
                                                                    @endif
                                                                    @if($user->Appreciation == 3)
                                                                        <span class="label label-success" style="background:#19aef5;">{{ __('Is not suitable 
                                                                            ') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td style="white-space: nowrap;">{{$user->phone}}</td>
                                                                <td>{{$user->email}}</td>
                                                                <td>
                                                                    <div style="white-space: nowrap;">
                                                                        @if($user->id == $id)
                                                                             <a href="/admin/candidat/edit/{{$user->id}}" class="mr-25" data-toggle="tooltip" data-original-title="{{ __('Edit') }}"> <i class="fa fa-pencil text-warning text-inverse m-r-10"></i> </a>
                                                                        @else 
                                                                            <a href="/admin/candidat/edit/{{$user->id}}" class="mr-25" data-toggle="tooltip" data-original-title="{{ __('Edit') }}"> <i class="fa fa-pencil text-warning text-inverse m-r-10"></i> </a>
                                                                            <input type="checkbox" id="{{$user->id}}" class="js-switch js-switch-1" data-color="#ff2a00"   {{ $user->active == 1 ? 'checked' : 'false'}} onchange="loadDoc({{$user->id}});" />
                                                                            

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
<script>
    function loadDoc(id) {
    if(this.cheked){
        window.location.href = "/admin/candidat/update_c_e/"+id;
    }
    else{
        window.location.href = "/admin/candidat/update_c_d/"+id;
    }
}
</script>

@endsection
