<?php

namespace Plugins\Faq\Http\Controllers;

use App\Http\Controllers\Controller;
use Plugins\Faq\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('faqs.viewAny');

        $faqs = Faq::paginate(30);
        return view('faq::admin.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('faqs.create');

        return view('faq::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('faqs.create');

        $request->validate([
            'ask' => 'required|min:3|max:100|unique:faqs',
            'answer' => 'required|min:3|max:400'
        ]);

        Faq::create([
            'ask' => $request->ask,
            'answer' => $request->answer
        ]);

        toastr()->primary("Faq message Created successfully.");
        return redirect()->route('admin.faqs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('faqs.show');

        return redirect()->route('admin.faqs.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $this->authorize('faqs.update');

        return view('faq::admin.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $this->authorize('faqs.update');

        $request->validate([
            'ask'    => 'required|unique:faqs,ask,'. $faq->id.',id',
            'answer' => 'required|min:3|max:400'
        ]);
        $faq->update([
            'ask'       => $request->ask,
            'answer'   => $request->answer
        ]);

        toastr()->primary("Faq message Created successfully.");
        return redirect()->route('admin.faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $this->authorize('faqs.delete');

        if($faq != null){
            $faq->delete();
        }
        toastr()->primary("Faq message delete successfully.");
        return back();
    }

}
