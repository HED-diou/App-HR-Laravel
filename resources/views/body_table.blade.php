@foreach ($bankdays as $bankday)
    <tr data-bankid="{{$bankday->id}}" class="mestds">
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
