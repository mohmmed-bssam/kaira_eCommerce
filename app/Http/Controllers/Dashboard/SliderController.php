<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('image')->latest()->paginate(env('PAGE_SIZE'));
        return view('dashboard.sliders.index', compact('sliders'));
    }
    public function create()
    {
        $slider = new Slider();

        return view('dashboard.sliders.create', compact('slider'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $slider = Slider::create([
            'title' => [
                'en' => $request->input('title_en'),
                'ar' => $request->input('title_ar'),
            ],
            'description' =>[
                'en' => $request->input('description_en'),
                'ar' => $request->input('description_ar'),
            ] ,
        ]);


        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/sliders', 'custom');
            $slider->image()->create([
                'path' => $path
            ]);
        }
        flash()->success('Slider created successfully.');
        return redirect()->route('dashboard.sliders.index');
    }
    public function edit(Slider $slider)
    {
        return view('dashboard.sliders.edit', compact('slider'));
    }
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
        ]);
        $slider->update([
            'title' => [
                'en' => $request->input('title_en'),
                'ar' => $request->input('title_ar'),
            ],
            'description' =>[
                'en' => $request->input('description_en'),
                'ar' => $request->input('description_ar'),
            ],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists

            File::delete(public_path($slider->image->path));

            $path = $request->file('image')->store('uploads/sliders', 'custom');
            $slider->image()->update([
                'path' => $path
            ]);


        }
        flash()->info('Slider updated successfully.');
        return redirect()->route('dashboard.sliders.index');
    }
    public function destroy(Slider $slider)
    {

        File::delete(public_path($slider->image->path));
        $slider->image()->delete();
        $slider->delete();
        flash()->warning('Slider deleted successfully.');
        return redirect()->route('dashboard.sliders.index');
    }
}
