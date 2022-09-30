<?php

namespace Plugins\Skill\Http\Controllers;

use App\Http\Controllers\Controller;
use Plugins\Skill\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('skills.viewAny');

        $skills = Skill::all();
        return view('skill::admin.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('skills.create');

        return view('skill::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('skills.create');

        $request->validate([
            'type'          => 'required|in:language,professional',
            'name'          => 'required',
            'percentage'    => 'required|integer',
        ]);

        Skill::create([
            'type'          => $request->type,
            'name'          => $request->name,
            'percentage'    => $request->percentage,
        ]);

        toastr()->primary("Skill message Created successfully.");
        return redirect()->route('admin.skills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('skills.show');

        return redirect()->route('admin.skills.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        $this->authorize('skills.update');

        return view('skill::admin.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('skills.update');

        $request->validate([
            'type'          => 'required|in:language,professional',
            'name'          => 'required',
            'percentage'    => 'required|integer',
        ]);

        Skill::where('id', $id)->update([
            'type'          => $request->type,
            'name'          => $request->name,
            'percentage'    => $request->percentage,
        ]);

        toastr()->primary("Skill message Update successfully.");
        return redirect()->route('admin.skills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        $this->authorize('skills.delete');

        if($skill != null){
            $skill->delete();
        }
        toastr()->primary("Skill message delete successfully.");
        return back();
    }
}
