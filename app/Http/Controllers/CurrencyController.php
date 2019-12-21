<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::orderBy('active', 'desc')->get();
        return view('admin.currency.index')->with('currencies', $currencies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currency.create');
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
            'code'      =>  'required',
            'symbol'      =>  'required',
            'exchange_rate'      =>  'required',
        ]);
        $currency = new Currency;
        $currency->name = $request->name;
        $currency->code = $request->code;
        $currency->symbol = $request->symbol;
        $currency->exchange_rate = $request->exchange_rate;

        $currency->save();
        return back()->with('success','You have successfully created a currency.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $currency = Currency::find($request->id);
        return view('admin.currency.edit')->with('currency', $currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'code'      =>  'required',
            'symbol'      =>  'required',
            'exchange_rate'      =>  'required',
        ]);
        $currency = Currency::find($request->id);
        $currency->name = $request->name;
        $currency->code = $request->code;
        $currency->symbol = $request->symbol;
        $currency->exchange_rate = $request->exchange_rate;

        $currency->save();
        return back()->with('success','You have successfully update a currency.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $currency = Currency::find($request->id);
        $currency->delete();
        return back()->with('success','You have successfully delete a currency.'); 
    }
}
