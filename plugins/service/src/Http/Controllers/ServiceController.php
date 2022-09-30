<?php

namespace Plugins\Service\Http\Controllers;

use App\Http\Controllers\Controller;
use Plugins\Service\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('services.viewAny');

        $services = Service::all();
        return view('service::admin.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('services.create');

        return view('service::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('services.create');

        $request->validate([
            'icon'          => "required|max:50",
            'name'          => 'required',
            'description'   => 'required',
        ]);

        Service::create([
            'icon'          => $request->icon,
            'name'          => $request->name,
            'description'   => $request->description,
        ]);

        toastr()->primary("Service message Created successfully.");
        return redirect()->route('admin.services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('services.show');

        return redirect()->route('admin.services.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $this->authorize('services.update');

        return view('service::admin.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('services.update');

        $request->validate([
            'icon'          => "required|max:50",
            'name'          => 'required',
            'description'   => 'required',
        ]);

        Service::where('id', $id)->update([
            'icon'          => $request->icon,
            'name'          => $request->name,
            'description'   => $request->description,
        ]);

        toastr()->primary("Service message Update successfully.");
        return redirect()->route('admin.services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->authorize('services.delete');

        if($service != null){
            $service->delete();
        }
        toastr()->primary("Service message delete successfully.");
        return back();
    }
}
