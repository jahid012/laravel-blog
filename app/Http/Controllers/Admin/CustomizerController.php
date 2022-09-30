<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Customizer;

class CustomizerController extends Controller
{
    /**
     * Current user id or session id
     * @var $user_id
     */
    public $user_id;

    /**
     * Default customizer attributues
     *
     * @var $select
     */
    private $select = array(
        'typography', 'version', 'layout', 'sidebarStyle', 'sidebarPosition',
        'headerPosition', 'containerLayout', 'direction', 'navheaderBg',
        'headerBg', 'sidebarBg'
    );

    public function __construct()
    {
        if (config('cms.demo')) {
            $this->user_id = session()->getId();
        } else {
            $this->user_id = (string)auth()->id();
        }
    }

    public function index(Request $request)
    {
        Customizer::firstOrCreate(['user_id' => $this->user_id]);

        if ($request->isMethod('get')) {
            $customizer = Customizer::select($this->select)
                            ->where(['user_id' => $this->user_id])->first()->toArray();

            return response()->json($customizer, 200);
        }

        if ($request->isMethod('post')) {
            $data = $this->store($request);
            return response()->json($data, $data['code']);
        }
    }

    private function store($request)
    {
        if (config('cms.admin_customizer') == false) {
            return;
        }
        $keyOriginalName = array(
            "theme_version"  => "version",
            "theme_layout"  => "layout",
            "sidebar_style" => "sidebarStyle",
            "sidebar_position" => "sidebarPosition",
            "header_position" => "headerPosition",
            "container_layout" => "containerLayout",
            "navigation_header" => "navheaderBg",
            "header_bg" => "headerBg",
            "sidebar_bg" => "sidebarBg",
            "direction" => "direction"
        );

        $dataArray = array();
        $dataArray['typography'] = ["roboto"];
        $dataArray['version'] = ["light", "dark"];
        $dataArray['layout'] = ['vertical', 'horizontal'];
        $dataArray['sidebarStyle'] = ['full', 'mini', 'compact', 'modern', 'overlay', 'icon-hover'];
        $dataArray['sidebarPosition'] = ['static', 'fixed'];
        $dataArray['headerPosition'] = ['static', 'fixed'];
        $dataArray['containerLayout'] = ['wide', 'boxed', 'wide-boxed'];
        $dataArray['headerBg'] = ["color_1", "color_2", "color_3", "color_4", "color_5", "color_6", "color_7", "color_8", "color_9", "color_10", "color_11", "color_12", "color_13", "color_14", "color_15",];
        $dataArray['navheaderBg'] = ["color_1", "color_2", "color_3", "color_4", "color_5", "color_6", "color_7", "color_8", "color_9", "color_10", "color_11", "color_12", "color_13", "color_14", "color_15",];
        $dataArray['sidebarBg'] = ["color_10", "color_1", "color_2", "color_3", "color_4", "color_5", "color_6", "color_7", "color_8", "color_9", "color_10", "color_11", "color_12", "color_13", "color_14", "color_15",];
        $dataArray['direction'] = ["ltr", "rtl"];

        $data = Customizer::select($this->select)->where('user_id', $this->user_id)->firstOrNew();


        foreach ($request->except(['_method', '_token']) as $key => $value) {

            if ($name = $keyOriginalName[$key]) {
                if (in_array($value, $dataArray[$name])) {

                    Customizer::where('user_id', $this->user_id)->update([$name => $value]);
                } else {
                    $data = ['message' => 'customizer fild value is not acepts [site bar]', 'code' => 404];
                }
            } else {
                return $data = ['message' => 'input field not found [site bar]', 'code' => 400];
            }
        }


        $data = Customizer::select($this->select)->where('user_id', $this->user_id)->first()->toArray();

        return array(
            'message' => 'Customizer Update Complate',
            'title' => 'Successfully Update',
            'statusText' => 'ok',
            'data' => $data,
            'code' => 200
        );
    }
}
