<?php

namespace Plugins\Portfolio\Http\Controllers;

use App\Http\Controllers\Controller;
use Plugins\Portfolio\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('portfolios.viewAny');

        $portfolios = Portfolio::all();
        return view('portfolio::admin.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('portfolios.create');

        return view('portfolio::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('portfolios.create');

        $request->validate([
            'image'          => 'required',
            'category'      => 'required',
            'title'         => 'required',
        ]);

        Portfolio::create([
            'image'          => $request->image,
            'category'      => $request->category,
            'title'         => $request->title,
        ]);

        toastr()->primary("Portfolio message Created successfully.");
        return redirect()->route('admin.portfolios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('portfolios.show');

        return redirect()->route('admin.portfolios.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        $this->authorize('portfolios.update');

        return view('portfolio::admin.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorize('portfolios.update');

        $request->validate([
            'image'          => 'required',
            'category'      => 'required',
            'title'         => 'required',
        ]);

        $portfolio->update([
            'image'          => $request->image,
            'category'      => $request->category,
            'title'         => $request->title,
        ]);

        toastr()->primary("Portfolio message Update successfully.");
        return redirect()->route('admin.portfolios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $this->authorize('portfolios.delete');

        if($portfolio != null){
            $portfolio->delete();
        }
        toastr()->primary("Portfolio message delete successfully.");
        return back();
    }
}
