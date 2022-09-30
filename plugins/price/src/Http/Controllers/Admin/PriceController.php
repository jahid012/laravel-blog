<?php

namespace Plugins\Price\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Plugins\Price\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('prices.viewAny');

        $prices = Price::all();
        return view('price::admin.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('prices.create');

        return view('price::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('prices.create');

        $request->validate([
            'icon' => 'required|min:3|max:30',
            'name' => 'required|min:3|max:255',
            'price' => 'required|min:1|max:4',
            'info' => 'required|min:3|max:400',
            'link' => 'required|min:1|max:255',
        ]);

        Price::create([
            'icon' => $request->icon,
            'name' => $request->name,
            'price' => $request->price,
            'info' => $request->info,
            'link' => $request->link,
        ]);

        toastr()->primary("Price message Created successfully.");
        return redirect()->route('admin.prices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Price $price
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('prices.show');

        return redirect()->route('admin.prices.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Price $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        $this->authorize('prices.update');

        return view('price::admin.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        $this->authorize('prices.update');

        $request->validate([
            'icon' => 'required|min:3|max:30',
            'name' => 'required|min:3|max:255|unique:prices,name,'.$price->id.',id',
            'price' => 'required|min:1|max:4',
            'info' => 'required|min:3|max:400',
            'link' => 'required|min:1|max:255',
        ]);

        $price->update([
            'icon' => $request->icon,
            'name' => $request->name,
            'price' => $request->price,
            'info' => $request->info,
            'link' => $request->link,
        ]);
        toastr()->primary("Price message Update successfully.");
        return redirect()->route('admin.prices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        $this->authorize('prices.delete');

        if($price != null){
            $price->delete();
        }
        toastr()->primary("Price message delete successfully.");
        return back();
    }
}
