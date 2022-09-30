<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menus.index', [ 'data' => Menu::all() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("menus.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:menus'
        ]);

        Menu::create([
            'name' => $request->name,
        ]);

        return redirect()->route('menus.index')->with(["message" => 'The Menu Create successfully.', 'alert-type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('menus.builder', compact('menu'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        // $this->authorize('menus.update');
        $request->validate([
            'name' => 'required|unique:menus,id,'. $menu->id,
        ]);

        Menu::where('id', $menu->id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('menus.index')->with(["message" => 'Menu Update Successfull', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if($menu != null){
            $menu->delete();
        }
        return back()->with(["message" => 'The Menu Delete successfully.', 'alert-type' => 'success']);
    }

    /**************************************************************** */
    /*****************************  menu item *********************** */
    /**************************************************************** */

    /**
     * Store a newly created menu item resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addItem(Request $request, Menu $menu)
    {
        $request->validate([
            "title"         => "required|min:2|max:20|string",
            "url"           => "required|min:1|max:255|string",
            "target"        => "in:_self,_blank",
            "icon_class"    => "nullable|string",
        ]);

        $item = MenuItem::create([
            'id'            => Str::uuid(),
            "title"         => $request->title,
            "url"           => $request->url,
            "target"        => $request->target,
            "icon"          => $request->icon_class,
            "parent_id"     => null,
            "order"         => 0,
            "menu_id"       => $menu->id,
        ]);

        if($request->ajax()){
            return response()->json($item->toArray(), 200);
        }

        return back()->with(["message" => 'The Menu Item Create successfully.', 'alert-type' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   uuid $item_id
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function updateItem(Request $request, $item_id)
    {
        $item = MenuItem::findOrFail($item_id);

        $request->validate([
            "title"         => "required|min:3|max:20|string",
            "url"           => "required|min:3|max:20|string",
            "target"        => "in:_self,_blank",
            "icon_class"    => "nullable|string",
        ]);

        $item->forceFill([
            "title"         => $request->title,
            "url"           => $request->url,
            "target"        => $request->target,
            "icon"          => $request->icon,
        ])->save();

        return back()->with(["message" => 'The Menu Item Order successfully.', 'alert-type' => 'success']);
    }

    /**
     *
     */
    public function orderItem(Request $request)
    {
        $menuItemOrder = json_decode($request->input('order'));
        $this->orderMenu($menuItemOrder, null);

        if($request->ajax()){
            return response()->json(["message" => 'The Menu Item Update successfully.', 'alert-type' => 'success']);
        }

        return back()->with(["message" => 'The Menu Item Update successfully.', 'alert-type' => 'success']);
    }

    private function orderMenu(array $menuItems, $parentId)
    {
        foreach ($menuItems as $index => $menuItem) {
            $item = MenuItem::findOrFail($menuItem->id);
            $item->order = $index + 1;
            $item->parent_id = $parentId;
            $item->save();

            if (isset($menuItem->children)) {
                $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuItem  $item
     * @return \Illuminate\Http\Response
     */
    public function destroyItem($id)
    {
        $items = MenuItem::where('parent_id', $id)->get();
        foreach ($items as $value) {
            $value->forceFill([
                'parent_id' => null
            ])->save();
        }

        // delete menu item
        $item = MenuItem::findOrFail($id);
        if($item != null){
            $item->delete();
        }
        return back()->with(["message" => 'The Menu item Delete successfully.', 'alert-type' => 'success']);
    }

}
