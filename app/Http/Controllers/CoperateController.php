<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class CoperateController extends Controller
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
        return view('pages.coperate');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->active == 0){
            return view('pages.createcoperate');
        }else{
            return redirect('/home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[

        ]);
        //check services
        $services = "";
        for ($i=1; $i <=6; $i++) {
            if($i == 1){
                if($request->has('service_'.$i)){
                    $services.=$request->input('service_'.$i);
                }
            }else{
                if($request->has('service_'.$i)){
                    $services.=','.$request->input('service_'.$i);
                }
            }

        }

        $contacts = "";
        for ($i=1; $i <=3; $i++) {
            if($i == 1){
                if($request->has('contact_'.$i)){
                    $contacts.=$request->input('contact_'.$i);
                }
            }else{
                if($request->has('contact_'.$i)){
                    $contacts.=','.$request->input('contact_'.$i);
                }
            }
        }

        $emails = "";
        for ($i=1; $i <=3; $i++) {
            if($i == 1){
                if($request->has('email_'.$i)){
                    $emails.=$request->input('email_'.$i);
                }
            }else{
                if($request->has('email_'.$i)){
                    $emails.=','.$request->input('email_'.$i);
                }
            }
        }

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        //handle file upload
        if($request ->hasFile('card_photo')){
            //get filename with the ext
            $fileNameWithExt = $request ->file('card_photo')->getClientOriginalName();
            //get just extension
            $extension = $request->file('card_photo')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore =  request()->get('firstName').'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('card_photo')->storeAs('public/card_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'male-avator.png';
        }

        $lastid=null;

        DB::transaction(function () use(&$contacts,&$emails,&$services) {
            $post_address = request()->get('postal_code').",".request()->get('postal_address').",".request()->get('city');
            $id = auth()->user()->user_id;

            $lastid = DB::table('card_details')->insertGetId([
                'phone_no' => $contacts,'email' => $emails,'company' => request()->get('company'),'physical_address' => request()->get('physical_address'),
                'post_address' => $post_address,'social_media' => request()->get('facebook_link'),'website' => request()->get('website'),'user_id'=>auth()->user()->user_id,
                'nature' => request()->get('biz_type'),'services' => $services,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
                ]);

            DB::table('users')->where('user_id',$id)->update([
                'active'=> 1,'updated_at' => \Carbon\Carbon::now()]);
        });

        return response()->json(['lastid'=>$lastid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff =  DB::table('card_profile')->select('email','active','position')->join('users', 'card_profile.user_id', '=', 'users.user_id')->where('details_id',$id)->get();

        return response()->json(['staff'=> $staff]);
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

    public function getDetailId(){
        $id = auth()->user()->user_id;

        $detailid =  DB::table('card_details')->select('details_id')->where('user_id',$id)->first();



        return response()->json(['id'=>$detailid]);
    }

    public function saveStaff(Request $request){
        for ($i=1; $i <= request()->get('total'); $i++) {
            DB::transaction(function () use(&$i) {

                $lastid = DB::table('users')->insertGetId([
                    'email' => request()->get('email-'.$i),'type' => 'coperate_user','password' => Hash::make('12345678'),'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
                ]);
                DB::table('card_profile')->insert(['position' => request()->get('position-'.$i),'details_id'=>request()->get('details-id'),
                'user_id'=>$lastid,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
                ]);
            });
        }

    }

    public function createCoperateUser(){

        if(auth()->user()->active == 0){
            return view('pages.coperateactivate');
        }else{
            return redirect('/home');
        }
    }

    public function updateCoperateUser(Request $request){
        $validator = \Validator::make($request->all(),[
            'card_photo' => 'image|nullable|max:1999',
            'password' => ['required', 'min:8','confirmed'],
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        //handle file upload
        if($request ->hasFile('card_photo')){
            //get filename with the ext
            $fileNameWithExt = $request ->file('card_photo')->getClientOriginalName();
            //get just extension
            $extension = $request->file('card_photo')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore =  request()->get('firstName').'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('card_photo')->storeAs('public/card_images', $fileNameToStore);
        }

        DB::transaction(function () use(&$fileNameToStore) {
            $full_name = request()->get('firstName')." ".request()->get('secondName')." ".request()->get('thirdName');
            $id = auth()->user()->user_id;

            DB::table('users')->where('user_id',$id)->update([
                'active'=> 1,'password' => Hash::make(request()->get('password')),'updated_at' => \Carbon\Carbon::now()]);


            DB::table('card_profile')->where('user_id',$id)->update([
                'designation' => request()->get('designation'),'full_name' => $full_name,'updated_at' => \Carbon\Carbon::now()]);

            if(request() ->hasFile('card_photo')){
                DB::table('card_profile')->where('user_id',$id)->update(['photo' => $fileNameToStore]);
            }
        });
    }

    public function showConnect($id){
        //request

    }
}
