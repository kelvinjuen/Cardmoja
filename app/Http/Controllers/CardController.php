<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CardController extends Controller
{
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
        return view('pages.createcard');
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
            $fileNameToStore = 'noimage.jpg';
        }

        $lastid=null;

        DB::transaction(function () use(&$lastid,&$fileNameToStore,&$contacts,&$emails,&$services) {
            $post_address = request()->get('postal_code').",".request()->get('postal_address').",".request()->get('city');
            $full_name = request()->get('firstName')." ".request()->get('secondName')." ".request()->get('thirdName');

            $lastid = DB::table('card_details')->insertGetId([
                'phone_no' => $contacts,'email' => $emails,'company' => request()->get('company'),'physical_address' => request()->get('physical_address'),
                'post_address' => $post_address,'social_media' => request()->get('facebook_link'),'website' => request()->get('website'),'user_id'=>auth()->user()->user_id,
                'nature' => request()->get('biz_type'),'services' => $services,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
             ]);

            DB::table('card_profile')->insert([
                'designation' => request()->get('designation'),'full_name' => $full_name,'position' => request()->get('position'),
                'photo' => $fileNameToStore,'details_id'=>$lastid,'user_id'=>auth()->user()->user_id,'updated_at' => \Carbon\Carbon::now()
                ,'created_at' => \Carbon\Carbon::now(),
            ]);


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
        $card= DB::table('card_profile')->join('card_details', 'card_profile.details_id', '=', 'card_details.details_id')->select('*')->where('card_profile.user_id',$id)->first();
        return response()->json(['card'=>$card]);
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
        }


        DB::transaction(function () use(&$id,&$fileNameToStore,&$contacts,&$emails,&$services) {
            $post_address = request()->get('postal_code').",".request()->get('postal_address').",".request()->get('city');
            $full_name = request()->get('firstName')." ".request()->get('secondName')." ".request()->get('thirdName');

            DB::table('card_details')->where('user_id',$id)->update([
                'phone_no' => $contacts,'email' => $emails,'company' => request()->get('company'),'physical_address' => request()->get('physical_address'),
                'post_address' => $post_address,'social_media' => request()->get('facebook_link'),'website' => request()->get('website'),
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
            }
        }else{
            $fileNameToStore = request()->get('background-select');
        }

        DB::table('card_details')->where('user_id', $id)->
        update(['type'=> request()->get('type-select'),'colour_1'=> request()->get('colour-1'),'colour_2'=> request()->get('colour-2')
        ,'bg_image'=> $fileNameToStore]);

        return response()->json(['success'=>'success']);

    }
}
