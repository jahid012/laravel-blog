<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('dashboard.viewAny');

        // users
        $numberOfUsers = User::count();
        //new
        $numberOfNewUsers = User::whereDate('created_at', Carbon::today())->count();
        //banned
        $numberOfBenUsers = User::where('status', 'banned')->count();
        //unconfirmed
        $numberOfUnconformUsers = User::where('status', 'unconfirmed')->count();
        //resent_users
        $resent_users = User::limit(5)->get();

        //registrationHistory
        $registrationHistory = User::countOfNewUsersPerMonth(
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );

        $loginPieChart = $this->loginStatistics();

        // login user
        $user = auth()->user();
        // my resent activities
        $myActivities = $this->getMyActivities();

        return view('dashboard.index', compact([
            'registrationHistory','resent_users',
            'numberOfUsers', 'numberOfNewUsers',
            'numberOfBenUsers', 'numberOfUnconformUsers',
            'loginPieChart', 'user', 'myActivities'])
        );
    }

    /**
     * Login statics usering platform
     */
    private function loginStatistics()
    {
        $currentMonth = date('m');
        $raw_data = Activity::select(['platform'])
                ->where('description' , 'Login In')
                ->whereMonth('created_at', (string) $currentMonth)
                ->get()->toArray();

        $data = [];

        foreach ($raw_data as $key => $value) {

            if(isset($data[$raw_data[$key]['platform']]) == false){
                $value = 0;
            }else{
                $value = $data[$raw_data[$key]['platform']]+1;
            }
            $data[$raw_data[$key]['platform']] = $value;
        }

        $backgroundColor = [];
        foreach (array_keys($data) as $key => $value) {

            $backgroundColor[$key] = $this->getRgbColor($key);
        }

        $dataset = [];
        $dataset['labels'] = array_keys($data);
        $dataset['datasets'][0] = array(
            "label" => "02",
            "data" => array_values($data),
            "hoverOffset" => 4,
            "backgroundColor" => $backgroundColor
        );

        return $dataset;
    }

    /**
     * my acitivies
     */

    public function getMyActivities()
    {
        return Activity::orderBy('created_at', 'DESC')->limit(5)->get();
    }

    public function getRgbColor($num) {

        $hash = md5('color' . $num); // modify 'color' to get a different palette

        $result = implode(",", [
            hexdec(substr($hash, 0, 2)), // r
            hexdec(substr($hash, 2, 2)), // g
            hexdec(substr($hash, 4, 2)) //b
        ]);

        return "rgb({$result})";
    }
}
