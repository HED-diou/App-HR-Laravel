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
                                                <a href="/admin/candidat/add_T"><button class= "creation btn btn-success btn-block btn btn-rounded btn-success" style="background:#333652; border:solid 1px #333652;width:200px;border-radius: 5px;">{{ __('ADD TECHNOLOGIE') }}</button></a>
                                            </li>
                                            <li class="create">
                                                <a href="/admin/candidat/add_H"><button class= "creation btn btn-success btn-block btn btn-rounded btn-success" style="background:#333652; border:solid 1px #333652;width:200px;border-radius: 5px;">{{ __('ADD HOBIE') }}</button></a>
                                            </li>
                                            
                                        </ul>
                                        <div class="table-wrap">
                                            <div class=" table-responsive col-sm-6 col-xs-12">
                                                <table class="table mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('ID') }}</th>
                                                        <th>{{ __('technologie') }}</th>
                                                        <th>{{__('Actions')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($technologies as $technologie)
                                                            <tr>
                                                                <td>{{$technologie->id}}</td>
                                                                <td>{{$technologie->name}}</td>
                                                                <td>
                                                                    <div style="white-space: nowrap;">
                                                                            <a href="/admin/candidat/edit_t/{{$technologie->id}}" class="mr-25" data-toggle="tooltip" data-original-title="{{ __('Edit') }}"> <i class="fa fa-pencil text-warning text-inverse m-r-10"></i> </a>
                                                                            <input type="checkbox" id="{{$technologie->id}}" class="js-switch js-switch-1" {{ $technologie->active == 1 ? 'checked' : 'false'}} data-color="#ff2a00" onchange="loadDoc_t({{$technologie->id}})" />
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class=" table-responsive col-sm-6 col-xs-12">
                                                <table class="table mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('ID') }}</th>
                                                        <th>{{ __('Hobie') }}</th>
                                                        <th>{{__('Actions')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($hobies as $hobie)
                                                        <tr>
                                                            <td>{{$hobie->id}}</td>
                                                            <td>{{$hobie->name}}</td>
                                                            <td>
                                                                <div style="white-space: nowrap;">
                                                                    
                                                                        <a href="/admin/candidat/edit_h/{{$hobie->id}}" class="mr-25" data-toggle="tooltip" data-original-title="{{ __('Edit') }}"> <i class="fa fa-pencil text-warning text-inverse m-r-10"></i> </a>
                                                                        <input type="checkbox" id="{{$hobie->id}}" class="js-switch js-switch-1" {{ $hobie->active == 1 ? 'checked' : 'false'}} data-color="#ff2a00" onchange="loadDoc({{$hobie->id}});" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
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
        window.location.href = "/admin/candidat/update_h_c_e/"+id;
    }
    else{
        window.location.href = "/admin/candidat/update_h_c_d/"+id;
    }
}

function loadDoc_t(id) {
    if(this.cheked){
        window.location.href = "/admin/candidat/update_t_c_e/"+id;
    }
    else{
        window.location.href = "/admin/candidat/update_t_c_d/"+id;
    }
}



//     function loadDoc(id) {
//   var xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//      document.getElementById("demo").innerHTML = this.responseText;
//     }
//   };
//   xhttp.open("post", "/admin/candidat/update_h_c/"+id, true);
//   xhttp.send();
// }
</script>
@endsection
