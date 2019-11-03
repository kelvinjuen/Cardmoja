<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function index(){
        return view('pages.index');
        Cache::put('cachekey','i am in the cache baby!',1);
    }
    public function coperateActivate(){
        return view('pages.coperateactivate');
    }

    public function contacts(){
        return view ('pages.contacts');
    }

    public function setting(){
        return view ('pages.setting');
    }

    public function contactus(){
        return view ('pages.contactus');
    }

}
