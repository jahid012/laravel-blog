<?php

namespace Plugins\Qualification\Http\Controllers;

use App\Http\Controllers\Controller;
use Plugins\Qualification\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('qualifications.viewAny');

        $qualifications = Qualification::all();
        return view('qualification::admin.index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('qualifications.create');

        return view('qualification::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('qualifications.create');

        $request->validate([
            'type'          => 'required|in:education,experience',
            'icon'          => "nullable|max:50",
            'name'          => 'required',
            'institute'     => 'required',
            'description'   => 'required',
            'start_at'      => 'required|date|date_format:Y-m-d|before:end_at',
            'end_at'        => 'required|date|date_format:Y-m-d|after:start_at',
        ]);

        Qualification::create([
            'type'          => $request->type,
            'icon'          => $request->icon,
            'name'          => $request->name,
            'institute'     => $request->institute,
            'description'   => $request->description,
            'start_at'      => $request->start_at,
            'end_at'        => $request->end_at,
        ]);

        toastr()->primary("Qualification message Created successfully.");
        return redirect()->route('admin.qualifications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Qualification $qualification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('qualifications.show');

        return redirect()->route('admin.qualifications.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Qualification $qualification
     * @return \Illuminate\Http\Response
     */
    public function edit(Qualification $qualification)
    {
        $this->authorize('qualifications.update');

        return view('qualification::admin.edit', compact('qualification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('qualifications.update');

        $request->validate([
            'type'          => 'required|in:education,experience',
            'icon'          => "nullable|max:50",
            'name'          => 'required',
            'institute'     => 'required',
            'description'   => 'required',
            'start_at'      => 'required|date|date_format:Y-m-d|before:end_at',
            'end_at'        => 'required|date|date_format:Y-m-d|after:start_at',
        ]);

        Qualification::where('id', $id)->update([
            'type'          => $request->type,
            'icon'          => $request->icon,
            'name'          => $request->name,
            'institute'     => $request->institute,
            'description'   => $request->description,
            'start_at'      => $request->start_at,
            'end_at'        => $request->end_at,
        ]);

        toastr()->primary("Qualification message Update successfully.");
        return redirect()->route('admin.qualifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qualification $qualification)
    {
        $this->authorize('qualifications.delete');

        if($qualification != null){
            $qualification->delete();
        }
        toastr()->primary("Qualification message delete successfully.");
        return back();
    }
}
