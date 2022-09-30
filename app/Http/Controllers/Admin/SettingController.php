<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Support\Env;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('setting.update');
        return view('settings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('setting.update');
        $data = [];
        //upload files
        foreach ($request->files as $key => $file) {
            $imageName = time().'.'.$file->getClientOriginalExtension();

            $file->move(base_path('storage/app/public/uploads/settings'), $imageName);
            $data[ $key ] = asset("storage/app/public/uploads/settings/{$imageName}");
        }

        // add inputs
        foreach ($request->except('_token') as $key => $value) {
            if( isset( $data[$key]) == false){
                if($value == null){
                    $value = "";
                }
                $data[$key] = $value;
            }
        }

        // store
        if(!empty($data)){
            option($data);
        }

        return back()->withSuccess("Setting update complete");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function general()
    {
        $this->authorize('setting.update');
        return view('settings.general');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth()
    {
        $this->authorize('setting.update');
        return view('settings.auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notifications()
    {
        $this->authorize('setting.update');
        return view('settings.notifications');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mail()
    {
        $this->authorize('setting.update');
        return view('settings.mail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_mail(Request $request)
    {
        $this->authorize('setting.update');
        $data = array(
            "MAIL_FROM_ADDRESS" => $request->input('env_mail_from_address'),
            "MAIL_FROM_NAME" => $request->input('env_mail_from_name'),
            "MAIL_MAILER" => $request->input('env_mail_driver'),
            "MAIL_HOST" => $request->input('env_mail_host'),
            "MAIL_USERNAME" => $request->input('env_mail_username'),
            "MAIL_PASSWORD" => $request->input('env_mail_password'),
            "MAIL_PORT" => $request->input('env_mail_port'),
            "MAIL_ENCRYPTION" => $request->input('env_mail_encryption')
        );

        foreach ($data as $key => $value) {
            if($value == null){
                unset($data[$key]);
            }
        }
        $env = new Env();
        $env = $env->update($data);
        $request->session()->flash('message', 'Mail Setting update Complete');

        if($request->ajax()){
            return response()->json(["status"=>"ok"], 200);
        }

        return redirect()->route('settings.mail');
    }

}
