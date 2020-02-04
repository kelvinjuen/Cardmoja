<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Socialite;
use Illuminate\Support\Facades\Session;
use Auth;
use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CardView;
use Jenssegers\Agent\Agent;

class CardController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redirectTo = '/';
    public function __construct()
    {
        $this->middleware(['auth','verified'],['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.showcard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->active == 0){
            return view('pages.createcard');
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
            'card_photo' => 'image|nullable|max:1999',
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
        for ($i=1; $i <=2; $i++) {
            if($i == 1){
                if($request->has('contact_'.$i)){
                    $contacts.=$request->input('contact_'.$i);
                }
            }else{
                if($request->has('contact_'.$i)){
                    $contacts.='/'.$request->input('contact_'.$i);
                }
            }
        }

        $emails = "";
        for ($i=1; $i <=2; $i++) {
            if($i == 1){
                if($request->has('email_'.$i)){
                    $emails.=$request->input('email_'.$i);
                }
            }else{
                if($request->has('email_'.$i)){
                    $emails.='/'.$request->input('email_'.$i);
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
            $fileNameToStore = 'noimage.jpg';
        }

        $lastid=null;

        DB::transaction(function () use(&$lastid,&$fileNameToStore,&$contacts,&$emails,&$services) {
            $post_address = request()->get('postal_code')."-".request()->get('postal_address')." ".request()->get('city');
            $full_name = request()->get('firstName')." ".request()->get('secondName')." ".request()->get('thirdName');
            $id = auth()->user()->user_id;

            $lastid = DB::table('card_details')->insertGetId([
                'phone_no' => $contacts,'email' => $emails,'company' => request()->get('company'),'physical_address' => request()->get('physical_address'),
                'post_address' => $post_address,'website' => request()->get('website'),'user_id'=>auth()->user()->user_id,
                'nature' => request()->get('biz_type'),'services' => $services,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
             ]);

            DB::table('card_profile')->insert([
                'designation' => request()->get('designation'),'full_name' => $full_name,'position' => request()->get('position'),
                'photo' => $fileNameToStore,'details_id'=>$lastid,'user_id'=>auth()->user()->user_id,'updated_at' => \Carbon\Carbon::now()
                ,'created_at' => \Carbon\Carbon::now(),
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
        $user =User::find($id);
        $card= DB::table('card_profile')->join('card_details', 'card_profile.details_id', '=', 'card_details.details_id')->select('*')->where('card_profile.user_id',$id)->first();
        $review= DB::table('review')->join('card_profile', 'review.reviewer', '=', 'card_profile.user_id')->select('*')->where('user',$id)->get();
        $setting = DB::table('user_setting')->select('*')->where('user_id',$id)->first();
        $user_id = 0;
        $contacts =[];


        if(Auth::check()){

            $user_id = Auth::user()->user_id;
            //contact
            $contacts = DB::table('connect')->select('full_name','user_id','status','photo','position')->join('card_profile',function($join){
                $join->on('connect.user_2','=','card_profile.user_id');
                $join->where('connect.user_1','=',auth()->user()->user_id);
                $join->orOn('connect.user_1','=','card_profile.user_id');
                $join->where('connect.user_2','=',auth()->user()->user_id);
            })->where(function($query)  use(&$id){
                $query->where('user_1',auth()->user()->user_id)->orwhere('user_2',auth()->user()->user_id);
            })->get();


        }
        //dd($user);
        $agent = new Agent();
        $platform = $agent->platform();

        if($user_id == 0){
            //$details =['greeting' => 'Hi '.$card->full_name, 'body' => 'your CardMoja card has been viewed' , 'thanks' => 'Please feel free to customize your notifications from CardMoja',
            //'actionText' => 'Check out who has viewed your card', 'actionURL' => url('/'), 'notifiable_type' => '101' ];
            //Notification::send($user, new CardView($details));

            DB::table('cardview')->insert([
                'user_id' => $id,'viewer_id' => $user_id,'device' => $platform,'updated_at' => \Carbon\Carbon::now()
                ,'created_at' => \Carbon\Carbon::now(),
            ]);


        }else if($user_id !== Auth::user()->user_id){
            DB::table('cardview')->insert([
                'user_id' => $id,'viewer_id' => $user_id,'device' => $platform,'updated_at' => \Carbon\Carbon::now()
                ,'created_at' => \Carbon\Carbon::now(),
            ]);
        }



        return response()->json(['card'=>$card, 'review'=>$review,'user_id'=> $user_id,'contacts' => $contacts,'setting'=>$setting]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.editcard');
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
        $validator = \Validator::make($request->all(),[
            'card_photo' => 'image|nullable|max:1999',
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
        for ($i=1; $i <=2; $i++) {
            if($i == 1){
                if($request->has('contact_'.$i)){
                    $contacts.=$request->input('contact_'.$i);
                }
            }else{
                if($request->has('contact_'.$i)){
                    $contacts.='/'.$request->input('contact_'.$i);
                }
            }
        }

        $emails = "";
        for ($i=1; $i <=2; $i++) {
            if($i == 1){
                if($request->has('email_'.$i)){
                    $emails.=$request->input('email_'.$i);
                }
            }else{
                if($request->has('email_'.$i)){
                    $emails.='/'.$request->input('email_'.$i);
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
            Storage::delete(['public/card_images/'.request()->get('imagetodelete')]);
        }


        DB::transaction(function () use(&$id,&$fileNameToStore,&$contacts,&$emails,&$services) {
            $post_address = request()->get('postal_code')."-".request()->get('postal_address')." ".request()->get('city');
            $full_name = request()->get('firstName')." ".request()->get('secondName')." ".request()->get('thirdName');

            DB::table('card_details')->where('user_id',$id)->update([
                'phone_no' => $contacts,'email' => $emails,'company' => request()->get('company'),'physical_address' => request()->get('physical_address'),
                'post_address' => $post_address,'website' => request()->get('website'),
                'nature' => request()->get('biz_type'),'services' => $services,'updated_at' => \Carbon\Carbon::now()]);


            DB::table('card_profile')->where('user_id',$id)->update([
                'designation' => request()->get('designation'),'full_name' => $full_name,'position' => request()->get('position')
                ,'updated_at' => \Carbon\Carbon::now()]);

            if(request() ->hasFile('card_photo')){
                DB::table('card_profile')->where('user_id',$id)->update(['photo' => $fileNameToStore]);
            }
        });
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
    public function socialMedia(){
        return view('pages.socialmedia');
    }
    public function saveLinks(Request $request){
        $links = request()->all();
        $link_final = null;
        $count = 0;

        foreach ($links as $key => $value) {
            if($key != null){
                if($key !== '_token'){

                    if($count == 0){
                        $link_final .= $key.'->'.$value;
                    }else{
                        $link_final .= ','.$key.'->'.$value;
                    }
                }
            }
            $count++;
        }
        DB::table('card_details')->where('user_id',auth()->user()->user_id)->update([
            'social_media' => $link_final,'updated_at' => \Carbon\Carbon::now()]);
    }
    public function design(){
        return view('pages.designcard');
    }
    public function saveDesign(Request $request){
        $fileNameToStore =null;
        $id = auth()->user()->user_id;
        if($request->has('upload')){
             //handle file upload
            if($request ->hasFile('upload')){
                //get filename with the ext
                $fileNameWithExt = $request ->file('upload')->getClientOriginalName();
                //get just filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //get just extension
                $extension = $request->file('upload')->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = 'custom_'.time().'.'.$extension;
                //upload image
                $path = $request->file('upload')->storeAs('public/background_images', $fileNameToStore);
                Storage::delete(['public/background_images/'.request()->get('imagetodelete')]);
            }
        }else if ($request->has('background-select')){
            $fileNameToStore = request()->get('background-select');
            Storage::delete(['public/background_images/'.request()->get('imagetodelete')]);
        }else{
            $fileNameToStore = request()->get('imagetodelete');
        }

        DB::table('card_details')->where('user_id', $id)->
        update(['type'=> request()->get('type-select'),'colour_1'=> request()->get('colour_1'),'colour_2'=> request()->get('colour_2')
        ,'bg_image'=> $fileNameToStore]);

        return response()->json(['success'=>'success']);

    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        //dd($user);

        $links = DB::table('card_details')->where('user_id',auth()->user()->user_id)->select('social_media')->first();

        $link = $links->social_media;
        $link_list = array();

        if(!empty($link)){
            $str_arr = explode (",", $link);
            $count = count($str_arr);
            for ($i=0; $i < count($str_arr) ; $i++) {
                $arr = explode ("->", $str_arr[$i]);
                for ($k=0; $k < count($arr); $k++) {
                    $link_list[$arr[0]] = $arr[1];
                }
            }
        }


        if($provider == 'facebook'){
            $link_list[$provider]  = $user->profileUrl;
        }

        if($provider == 'github'){
            $link_list[$provider]  = 'https://github.com/'.$user->nickname;
        }


        $link_final = null;
        $count = 0;

        foreach ($link_list as $key => $value) {

            if($count == 0){
                $link_final .= $key.'->'.$value;
            }else{
                $link_final .= ','.$key.'->'.$value;
            }

            $count++;
        }

        DB::table('card_details')->where('user_id',auth()->user()->user_id)->update([
            'social_media' => $link_final,'updated_at' => \Carbon\Carbon::now()]);

        //return response()->json(['user' => $user]);
        return redirect('/links');
    }
    public function TwitterCallback()
    {
        $twitter =   Socialite::driver('twitter')->user();
        //dd($twitter);


        $links = DB::table('card_details')->where('user_id',auth()->user()->user_id)->select('social_media')->first();

        $link = $links->social_media;
        $link_list = array();

        if(!empty($link)){
            $str_arr = explode (",", $link);
            for ($i=0; $i < count($str_arr) ; $i++) {
                $arr = explode ("->", $str_arr[$i]);
                for ($k=0; $k < count($arr); $k++) {
                    $link_list[$arr[0]] = $arr[1];
                }
            }
        }

        $link_list['twitter']  = 'https://twitter.com/'.$twitter->nickname;


        $link_final = null;


        $count = 0;
        foreach ($link_list as $key => $value) {
            if($count == 0){
                $link_final .= $key.'->'.$value;
            }else{
                $link_final .= ','.$key.'->'.$value;
            }
            $count++;
        }

        DB::table('card_details')->where('user_id',auth()->user()->user_id)->update([
            'social_media' => $link_final,'updated_at' => \Carbon\Carbon::now()]);
        //return response()->json(['user' => $user]);
        return redirect('/links');

    }
}
