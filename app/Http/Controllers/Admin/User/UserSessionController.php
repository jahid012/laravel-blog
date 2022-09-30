<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class UserSessionController extends Controller
{
 /**
     * @var Agent
     */
    private $agent;

    /**
     * UserSessionController constructor.
     * @param Agent $agent
     */
    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $this->authorize('profile.session');
        $sessions = DB::table('sessions')->where( 'user_id', auth()->id() )->get();

        $data = [];
        foreach ($sessions as $k => $value) {
            $this->agent->setUserAgent($value->user_agent);
            $data[$k] = array(
                'id' => $value->id,
                'ip_address' => $value->ip_address,
                'user_id' => $value->user_id,
                'device' => $this->agent->device(),
                'platform' => $this->agent->platform(),
                'browser' => $this->agent->browser(),
                'last_activity' => $value->last_activity,
                'updated_at' => Carbon::parse(date("Y-m-d H:i:s", $value->last_activity))->diffForHumans(),
            );
        }

        return view('profile.session', compact('data'));
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
        try {
            DB::table('sessions')->delete($id);
        } catch (\Throwable $th) {
            return back()->withError("Unable to revoke Session");
        }

        return redirect()->route('profile.session')->withSuccess('User revokeSession successfull.⚡️');
    }

}
