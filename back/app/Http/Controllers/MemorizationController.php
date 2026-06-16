<?php

namespace App\Http\Controllers;

use App\Models\Memorization;
use App\Models\Memorization_Image;
use Illuminate\Http\Request;

class MemorizationController extends Controller
{
    public function index()
    {
        $memorizations = Memorization::all();
        $memorization_images = Memorization_Image::all();
        return view('frontsite.Quran_memorization', compact('memorizations', 'memorization_images'));
    }

    public function api_index()
    {
        $memorizations = Memorization::all();
        $memorization_images = Memorization_Image::all();
    
        return response()->json([
            'memorizations' => $memorizations,
            'memorization_images' => $memorization_images,
        ], 200);
    }

    
    public function create()
    {
        $memorization = Memorization::all();
        return view('backsite.create_memorization', compact('memorization'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'about' => 'required',

        ]);

        $new_Memorization = Memorization::create($data);
        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                $url = 'memorization\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
                $image->move(public_path('storage/memorization'), $url);
                Memorization_Image::create([
                    'memorization_id' => $new_Memorization->id,
                    'image' => $url
                ]);
            }
        }
        return redirect()->route('memorization-post');
    }


    public function show(Memorization $memorization)
    {
        //
    }


    public function edit(Memorization $memorization)
    {
        $memorization = Memorization::all();
        $memorization_image = Memorization_Image::all();
        return view("backsite.update_memorization", compact('memorization', 'memorization_image'));
    }


    public function update(Request $request, Memorization $memorization)
    {
        $data = $request->validate([
            'about' => 'required',
        ]);
        $memorization = Memorization::find($request->hidden_id);
        $memorization->about = $data['about'];
        $memorization->save();
        return redirect()->route('memorization-edit');
    }
    public function image_edit(Request $request, $id)
    {
        $memorization_image = Memorization_Image::find($id);
        return view('backsite.update_memorization_image', compact('memorization_image'));
    }
    public function image_upload(Request $request, Memorization_Image $memorization_image)
    {
        $image = $request->file('image');
        $memorization_image = Memorization_Image::find($request->hidden_id);
        $img = '/storage/' . $memorization_image->image;
        $mainPath = public_path();
        unlink(str_replace('\\', '/', $mainPath . $img));
        if ($request->hasFile('image')) {
            $url = 'memorization\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $image->move(public_path('storage/memorization'), $url);
            $memorization_image['image'] = $url;
            $memorization_image->save();
        }
        return redirect()->route('memorization-edit');
    }

    public function destroy(Memorization $memorization)
    {
        //
    }
}
