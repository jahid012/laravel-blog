<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Activity;
use App\Http\Controllers\Controller;

/**
 * Class ActivityController
 * @package Vanguard\Http\Controllers
 */
class ActivityController extends Controller
{
    /**
     * @var Activity
     */
    private $activities;

    /**
     * ActivityController constructor.
     * @param Activity $activities
     */
    public function __construct(Activity $activities)
    {
        $this->activities = $activities;
    }

    /**
     * Displays the page with activities for all system users.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $this->authorize('activity.viewAny');

        $user_id = $request->input('user_id');
        if($user_id){
            $data = $this->activities->where('user_id', $user_id)->paginate(15);
        }else{
            $data = $this->activities->paginate(15);
        }

        return view('activity.index', [
            'data' => $data
        ]);
    }
}
