<?php

namespace App\Http\Controllers;

use App\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets = Widget::orderBy('id', 'desc')->get();
        return view('admin.widget.index')->with('widgets', $widgets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.widget.create');
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
            'content'      =>  'required',
            'position'      =>  'required',
        ]);
        $widget = new Widget;
        $widget->title = $request->title;
        $widget->content = $request->content;
        $widget->position = $request->position;

        $widget->save();
        return back()->with('success','You have successfully created a widget.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function show(Widget $widget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $widget = Widget::find($request->id);
        return view('admin.widget.edit')->with('widget', $widget);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'content'      =>  'required',
            'position'      =>  'required',
        ]);

        $widget = Widget::find($request->id);
        if($widget){
            $widget->title = $request->title;
            $widget->content = $request->content;
            $widget->position = $request->position;

            $widget->save();
            return back()->with('success','You have successfully update a widget.');  
        }else{
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $widget = Widget::find($request->id);
        if($widget){
            $widget->delete();
            return back()->with('success','You have successfully delete a widget.');  
        }else{
            return back();
        }
    }
}
