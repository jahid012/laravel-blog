<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Activity;

class UserActivityController extends Controller
{
    /**
     * @var User
     */
    private $activity;

    /**
     * UserActivityController constructor.
     * @param Activity $activity
     */
    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $this->authorize('profile.activity');
        $data =  $this->activity->where('user_id', auth()->id() )->paginate(15);

        return view('profile.activity', compact('data'));
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('profile.session');
        $activity = $this->activity->where('id', $id)->first();

        if($activity != null){
           $activity->delete();
        }

        return redirect()->route('profile.activity')->withSuccess('User delete activity successfull.⚡️');
    }
}
