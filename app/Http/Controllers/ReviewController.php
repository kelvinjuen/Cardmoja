<?php

namespace App\Http\Controllers;

use App\Notifications\reviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Notification;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if($request -> hasAny(request()->get('anonymous'))){
            $anonymous = request()->get('anonymous');
        }else{
            $anonymous = 0;
        }

        DB::table('review')->updateOrInsert([
            'reviewer'=>auth()->user()->user_id,'user' => request()->get('card-id')],['anonymous' => $anonymous ,'rating'=> request()->get('rating'),
            'comment' => request()->get('comments'),'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
        ]);
        $user =User::find(request()->get('card-id'));
        $details =['greeting' => 'Hi', 'body' => 'your Digital card has been reviewed' , 'thanks' => 'Please feel free to customize your notifications from CardMoja',
        'actionText' => 'Check out who has reviewed your card', 'actionURL' => url('/'), 'notifiable_type' => '102' ];
        Notification::send($user, new reviewNotification($details));
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
        //
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
}
