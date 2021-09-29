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
<div class="page-wrapper" style="min-height: 937px;">
    <div class="container-fluid pt-25">
        <!-- Row -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-yellow">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-light block counter"><span class="counter-anim">{{$user['0']->balance}}</span> days</span>
                                            <span class="weight-500 uppercase-font txt-light block">My balance </span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="fa fa-calendar txt-light data-right-rep-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-blue">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <span class="txt-light block counter"><span class="counter-anim">{{$countempcong}}</span></span>
                                            <span class="weight-500 uppercase-font txt-light block">EMPLOYEE ON LEAVE</span>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                                            <i class="fa fa-users txt-light data-right-rep-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-red">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div style="margin-bottom: 35px" class=" col-lg-12 col-xs-12 text-center pl-0 pr-0 data-wrap-left ">
                                            <span class="txt-light block counter">Follow-up of my requests</span>
                                            <hr style="border-top-color :white">
                                            @if($countreq>0)
                                                <div>
                                                   <span style=" margin:auto" class=" weight-500  txt-light block ">
                                                    <ul >
                                                        @foreach($requests as $request)
                                                                       <li class="request-dash clicked txt-light" onclick="modalfunc({{ $request->request_id }})">
                                                                        # : {{$request->request_id}} FROM   {{$request->start_date}}  --> {{$request->end_date}} , {{$request->name}}.
                                                                    </li>
                                                        @endforeach
                                                          <li>
                                                              <a href="{{route('requests')}}" style="color: white; display: block; text-align: right ;margin-right: 5px" >
                                                                <i class="ti-arrow-right bg-white">
                                                                </i>
                                                            </a>
                                                          </li>
                                                     </ul>
                                                   </span>
                                                </div>
                                            @else
                                                <span class=" weight-500  txt-light block font-13"> No request to process</span>
                                                <a href="{{route('requests')}}" class="" style="color: white; display: block; text-align: right" >
                                                    <i class="ti-arrow-right bg-white">
                                                    </i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-green">
                                <div class="container-fluid">
                                    <div class="row pb-5 mb-5">
                                        <span class="weight-500 pt-5 mt-5  text-center next txt-light block  counter"> The next bank holiday </span>

                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                            <ul class="liste">
                                                <li>{!! $proche_bankday[0]->holiday_name !!}</li>
                                                <li>{!! $proche_bankday[0]->start_date !!}</li>

                                                <li>{!! $proche_bankday[0]->end_date !!}</li>

                                            </ul>
                                        </div>
                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                            <i class="fa fa-clock-o txt-light data-right-rep-icon"></i>
                                            <span class="txt-light block counter">  <p id="demo"></p></span>
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
        var types = '{{ $types }}';
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            const now = Date.now();
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                initialDate:now,
                navLinks: true,
                editable: true,
                dayMaxEvents: true,
                events: [
                        @foreach($bankdays as $bankday)
                    {
                        id:' {{$bankday->id}}',
                        title:'{{$bankday->holiday_name}}',
                        start:'{{$bankday->start_date}}',
                        end:'{{$bankday->end_date}}',
                        description:'{{$bankday->type_id}}',
                        overlap: false,
                        rendering: 'background',
                        color: '#2879ff'
                    },
                        @endforeach
                        @foreach($empcongs as $empcong)
                    {
                        id:' {{$empcong->request_id}}',
                        title:'Congé : '+'{{$empcong->requesterln}} {{$empcong->requesterfn}}',
                        start:'{{$empcong->start_date}}',
                        end:'{{$empcong->end_date}}',
                        overlap: false,
                        rendering: 'background',
                        color: '#ff2a00',

                    },
                    @endforeach
                ],
            });
            calendar.render();
        });
        function modalfunc(variable){
            var rows = '';
            @foreach($request_history as $request)
            if('{{$request->request_id}}'== variable){
                $('#myLargeModalLabel').html( 'Request ID : ' +' {{ $request->request_id }}');
                $('#usermodal').html( 'Requester : ' + '{!! $request->requesterfn !!}');
                rows = rows + '<tr><td>{!! $request->request_id !!}</td> <td>{!! $request->start_date !!}</td> <td>{!! $request->end_date !!}</td> <td>{!! $request->dayscount !!}</td>';
                var action = '{{$request->latest_action}}';

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

        var countDownDate = new Date('{!! $proche_bankday[0]->start_date !!}').getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML =  days + " Day " + hours + " Hour "
                + minutes + " min " + seconds + " sec ";

            // If the count down is over, write some text
            if (distance < 0) {
                //
                location.reload();
            }
        }, 1000);
    </script>
@endsection
