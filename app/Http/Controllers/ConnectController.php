<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ConnectController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.request');
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
        if(4)
        DB::table('connect')->insert(['user_1'=>request()->get('user_1'),'user_2'=>request()->get('user_2')
        ,'action_user'=>request()->get('user_1'),'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now()]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        DB::table('connect')->where('connect_id',request()->get('connect_id'))->update(['status'=> request()->get('status')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showConnect(){
        //contacts
        $id = auth()->user()->user_id;

        //contact
        $contacts = DB::table('connect')->select('full_name','user_id','photo','position','status','action_user','connect_id','status as rating','status as total')->join('card_profile',function($join){
            $join->on('connect.user_2','=','card_profile.user_id');
            $join->where('connect.user_1','=',auth()->user()->user_id);
            $join->orOn('connect.user_1','=','card_profile.user_id');
            $join->where('connect.user_2','=',auth()->user()->user_id);
        })->where(function($query){
            $query->where('user_1',auth()->user()->user_id)->orwhere('user_2',auth()->user()->user_id);
        })->get();

        foreach ($contacts as &$value) {
            $rating = DB::table('review')->select(DB::raw('avg(rating) as rating , count(rating) as total'))->where('user',$value->user_id)->first();
            $value->rating = $rating->rating;
            $value->total = $rating->total;
        }

        //suggestion
        $suggestion = DB::select(DB::raw("SELECT u.full_name ,u.user_id,u.photo,u.position FROM card_profile AS u WHERE NOT EXISTS (SELECT * FROM connect AS c WHERE (c.user_1 = u.user_id AND c.user_2 = '$id' ) OR (c.user_1 = '$id' AND c.user_2 = u.user_id)) AND u.user_id <> '$id'"));



        return response()->json(['contacts'=> $contacts]);
    }
}
