<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    public function index()
    {
        $sliders = $this->slider->with('media')->get();
        return view('admin.slider.index', compact('sliders'));
    }
    public function create()
    {
        return view('admin.slider.create');
    }
    public function store(StoreSliderRequest $request)
    {
        $slider =  $this->slider->create($request->validated());
        $slider->addFilePondMedia($request, $slider, 'sliders');

        return redirect()->route('admin.sliders.index')->with($slider->alertSuccess('store'));
    }
    public function show(Slider $slider)
    {
        //
    }
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $slider->update($request->validated());

        $slider->editFilePondMedia($request, $slider, 'sliders');

        return redirect()->route('admin.sliders.index')->with($slider->alertSuccess('update'));
    }

    public function destroy(Slider $slider)
    {
        return $slider->destroyModelHasImage($slider, 'sliders');
    }
    public function destroyMultiple(Request $request)
    {
        $ids = explode(",", $request->ids);

        $this->slider->whereIn('id', $ids)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], 200);
    }
    public function forceDestroy(int $id)
    {
        $slider = $this->slider->withTrashed()->findOrFail($id);
        $slider->clearMediaCollection('categories');
        $slider =  $slider->forceDelete();

        return redirect()->back()->with($this->slider->alertSuccess('success'));
    }
    public function forceDestroyMultiple(Request $request)
    {
        $ids = explode(",", $request->ids);
        $sliders = $this->slider->whereIn('id', $ids)->withTrashed()->get();
        foreach ($sliders as $slider) {
            $slider->clearMediaCollection('categories');
            $slider->forceDelete();
        }
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], 200);
    }
    public function restore(int $id)
    {
        $slider = $this->slider->withTrashed()->findOrFail($id);
        if ($slider && $slider->trashed()) {
            $slider->restore();
            return redirect()->back()->with($slider->alertSuccess('restore'));
        }
    }
    public function restoreMultiple(Request $request)
    {
        $ids = explode(",", $request->ids);

        $sliders = $this->slider->whereIn('id', $ids)->withTrashed()->get();
        foreach ($sliders as $slider) {
            $slider->restore();
        }
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], 200);
    }
}
