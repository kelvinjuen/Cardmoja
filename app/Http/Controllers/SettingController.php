<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SettingController extends Controller
{
    public function SaveSetting(Request $request){
        DB::table('user_setting')->updateOrInsert(['user_id'=>auth()->user()->user_id],
        ['phone' => request()->get('phone') ,'email'=> request()->get('email'),'physical' => request()->get('address')
        ,'post' => request()->get('post'),'social_links' => request()->get('links'),'card_link' => request()->get('card_link')
        ,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
        ]);
    }

    public function getSetting($id){
        $setting = DB::table('user_setting')->select('*')->where('user_id',$id)->first();
        return response()->json(['setting'=>$setting]);
    }
}
