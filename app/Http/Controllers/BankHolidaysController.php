<?php

namespace App\Http\Controllers;

use App\Models\BankHolidays;
use App\Models\Holyears;

use App\Models\Years;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankHolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = DB::table('holiday_type')->get();
        $year=DB::table('years')->get();
        return view('bank_holiday', compact ('types','year'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function annees()
    {
        $years=DB::table('years')->paginate(5);
        return view('years', compact ('years'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listing($id)
    {
        $holyids=DB::table('holyears')->select('holiday_id')->where('year_id','=', $id)->get();
        $holiday_id=[];
        foreach ($holyids as $holyid){
            $holiday_id[]=$holyid->holiday_id;
        }
        $bankdays = BankHolidays::wherein('id', $holiday_id)->paginate(5);
        /*$sqlQuery =" select * from bank_holiday where id in(SELECT holiday_id from holyears WHERE year_id= $id)";
        $bankdays = DB::select(DB::raw($sqlQuery));*/
        //dd($bankdays);
        $holyears=DB::table('holyears')->get();
        $types = DB::table('holiday_type')->get();
        $year=DB::table('years')->get();
        return view('listing_bankholiday', compact ('bankdays','types','year','holyears', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'holiday_name' => 'required',
            'start_date'=>'required',
            'end_date' => 'required',
            'type_id' => 'required ',
           'year_id'=>'required'
       ],
       [   'holiday_name.required'=>'Bank holiday name  is required , please fill in the field',
               'start_date.required'=>'Start date  is required, please fill in the field',
               'end_date.required'=>'End date   is required, please fill in the field',
               'type_id.required'=>'Holiday type  is required, please fill in the field',
               'year_id.required'=>'Holiday Year  is required, please fill in the field',
       ]);
        $bank = BankHolidays::create($request->all());
        $holyears = Holyears::make([
            'year_id' => $request['year_id'],
            'holiday_id' =>$bank->id
        ]);
        $holyears->save();
        $listing_jrferie = DB::table('bank_holiday')->get();
        $types = DB::table('holiday_type')->get();
        $year=DB::table('years')->get();
        return redirect()->route('bank.index', compact ('types','year'))->with('success','The new public holiday has been added to the database');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function year(Request $request)
    {
        $request->validate([
            'year' => 'required',
        ]);
        $year = Years::create($request->all());
        $listing_jrferie = DB::table('bank_holiday')->get();
        $types = DB::table('holiday_type')->get();
        $year=DB::table('years')->get();
        return redirect()->route('bank.index', compact ('types','year'))->with('success','The year has been added to the database');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bank=BankHolidays::where('id', $id)
            ->update(['holiday_name' => $request->input('holiday_name'),
                    'start_date'=>$request->input('start_date'),
                    'end_date'=>$request->input('end_date'),
                    'type_id'=>$request->input('type_id'),
                    ]
            );
        $holyears=holyears::where('holiday_id', $id)
            ->update(['year_id' => $request->input('year_id')
                ]
            );
        $years=DB::table('years')->get();
        return redirect()->route('bank.annees', compact ('years'))->with('success','The  public holiday has been uptdated');
    }
    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = BankHolidays::where('id', $request->id)->delete();
        $deletes = Holyears::where('holiday_id', $request->id)->delete();
        if ($delete == 1 ) {
            die("yess");
        } else {
            die('noo');
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
    public function filtreType(Request $request)
    {
        $holyears=DB::table('holyears')->get();
        $types = DB::table('holiday_type')->get();
        $year=DB::table('years')->get();
        $id=$request->year;
        if($request->type=="all"){
            $sqlQuery =" select * from bank_holiday where id in(SELECT holiday_id from holyears WHERE year_id= $id) ";
            $bankdays = DB::select(DB::raw($sqlQuery));
            $holyids=DB::table('holyears')->select('holiday_id')->where('year_id','=', $id)->get();
            $holiday_id=[];
            foreach ($holyids as $holyid){
                $holiday_id[]=$holyid->holiday_id;
            }
            $bankdays = BankHolidays::wherein('id', $holiday_id)->paginate(5);
        }else{
            $sqlQuery =" select * from bank_holiday where type_id=$request->type AND  id in(SELECT holiday_id from holyears WHERE year_id= $id)";
            $bankdays = DB::select(DB::raw($sqlQuery));
        }
        return view('body_table', compact ('bankdays','types','year','holyears', 'id'));
    }*/
    /**
     * Remove the specified resource from storage.
     * @param  int  $type
     * @param  int  $yearid
     * @return \Illuminate\Http\Response
     */
    public function filtreType($type,$yearid)
    {
        $holyears=DB::table('holyears')->get();
        $types = DB::table('holiday_type')->get();
        $year=DB::table('years')->get();
        $id=$yearid;
        if($type=="all"){
           /* $holyids=DB::table('holyears')->select('holiday_id')->where('year_id','=', $id)->get();
            $holiday_id=[];
            foreach ($holyids as $holyid){
                $holiday_id[]=$holyid->holiday_id;
            }
            $bankdays = BankHolidays::wherein('id', $holiday_id)->paginate(5);*/
            return redirect()->route('bank.listing',['id' => $id]);

        }else{
            $holyids=DB::table('holyears')->select('holiday_id')->where('year_id','=', $id)->get();
            $holiday_id=[];
            foreach ($holyids as $holyid){
                $holiday_id[]=$holyid->holiday_id;
            }
            $bankdays = BankHolidays::wherein('id', $holiday_id)->where('type_id',$type)->paginate(5);
            return view('listing_bankholiday', compact ('bankdays','types','year','holyears', 'id'));
          /*  $sqlQuery =" select * from bank_holiday where type_id=$type AND  id in(SELECT holiday_id from holyears WHERE year_id= $id)";
            $bankdays = DB::select(DB::raw($sqlQuery));*/
        }

    }


}
