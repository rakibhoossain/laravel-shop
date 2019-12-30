<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('id', 'desc')->paginate(10);
        return view('admin.slider.index')->with('sliders', $sliders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'title'      =>  'required|max:150',
            'body'      =>  'required',
            'image'      =>  'required',
        ]);

        $slider = new Slider;
        $slider->title = $request->title;
        $slider->body = $request->body;
        $slider->url = $request->url;
        $slider->button = $request->button;
        $slider->image = $this->saveSliderImage($slider, $request);

        $slider->save();
        return back()->with('success','You have successfully created a slider.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $slider = Slider::find($request->id);
        return view('admin.slider.edit')->with('slider', $slider);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title'      =>  'required|max:150',
            'body'      =>  'required',
        ]);

        $slider = Slider::find($request->id);
        if ($slider) {
            $slider->title = $request->title;
            $slider->body = $request->body;
            $slider->url = $request->url;
            $slider->button = $request->button;
            if ($request->hasFile('image')) {
                $this->deletSliderImage($slider);
                $slider->image = $this->saveSliderImage($slider, $request);
            }
            $slider->save();
            return back()->with('success','You have successfully update a slider.');  
        }
        return back()->withError('Invalid slider.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slider = Slider::find($request->id);
        if ($slider) {
            $this->deletSliderImage($slider);
            $slider->delete();
            return back()->with('success','You have successfully delete a slider.');  
        }
        return back()->withError('Invalid slider.');
    }

    private function deletSliderImage($slider){
        if( $slider->image ){
            $imgDestroy = public_path('images/slider/'.$slider->image);
            if ( file_exists($imgDestroy) ) unlink($imgDestroy);
        }
    }

    private function saveSliderImage($slider, $request){
        $image = $request->file('image');
        $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
        $location = public_path('images/slider/'.$img);
        // Image::make($image)->resize(360, 250)->save($location_thumb);
        Image::make($image)->save($location);
        return $img;
    }

}
