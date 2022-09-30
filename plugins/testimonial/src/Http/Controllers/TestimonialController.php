<?php

namespace Plugins\Testimonial\Http\Controllers;

use App\Http\Controllers\Controller;
use Plugins\Testimonial\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('testimonials.viewAny');

        $testimonials = Testimonial::all();
        return view('testimonial::admin.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('testimonials.create');

        return view('testimonial::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('testimonials.create');

        $request->validate([
            'quote'          => 'required',
            'author_name'    => 'required',
            'author_image'   => 'required',
            'author_intro'   => 'required',
        ]);

        Testimonial::create([
            'quote'            => $request->quote,
            'author_name'      => $request->author_name,
            'author_image'     => $request->author_image,
            'author_intro'     => $request->author_intro,
        ]);

        toastr()->primary("Testimonial message Created successfully.");
        return redirect()->route('admin.testimonials.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('testimonials.view');

        return redirect()->route('admin.testimonials.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        $this->authorize('testimonials.update');

        return view('testimonial::admin.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('testimonials.update');

        $request->validate([
            'quote'          => 'required',
            'author_name'    => 'required',
            'author_image'   => 'required',
            'author_intro'   => 'required',
        ]);

        Testimonial::where('id', $id)->update([
            'quote'            => $request->quote,
            'author_name'      => $request->author_name,
            'author_image'     => $request->author_image,
            'author_intro'     => $request->author_intro,
        ]);

        toastr()->primary("Testimonial message Update successfully.");
        return redirect()->route('admin.testimonials.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $this->authorize('testimonials.delete');

        if($testimonial != null){
            $testimonial->delete();
        }
        toastr()->primary("Testimonial message delete successfully.");
        return back();
    }
}
