<?php

namespace App\Http\Controllers;

use App\Models\Creative;
use App\Models\Creative_Image;
use Illuminate\Http\Request;

class CreativeController extends Controller
{

    public function index()
    {
        $creatives = Creative::all();
        $creative_images = Creative_Image::all();
        return view('frontsite.CreativeSection', compact('creatives', 'creative_images'));
    }

    public function create()
    {
        $creative = Creative::all();
        return view('backsite.create_creative', compact('creative'));
    }
    
    public function api_index()
    {
        $creatives = Creative::all();
        $creative_images = Creative_Image::all();
    
        return response()->json([
            'creatives' => $creatives,
            'creative_images' => $creative_images,
        ], 200);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'about' => 'required',

        ]);

        $new_creative = Creative::create($data);
        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                $url = 'creative\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
                $image->move(public_path('storage/creative'), $url);
                Creative_Image::create([
                    'creative_id' => $new_creative->id,
                    'image' => $url
                ]);
            }
        }
        return redirect()->route('creative-post');
    }


    public function show(Creative $creative)
    {
        //
    }

    public function edit(Creative $creative)
    {
        $creative = Creative::all();
        $creative_image = Creative_Image::all();
        return view("backsite.update_creative", compact('creative', 'creative_image'));
    }


    public function update(Request $request, Creative $creative)
    {
        $data = $request->validate([
            'about' => 'required',
        ]);
        $creative = Creative::find($request->hidden_id);
        $creative->about = $data['about'];
        $creative->save();
    }
    public function image_edit(Request $request, $id)
    {
        $creative_image = Creative_Image::find($id);
        return view('backsite.update_creative_image', compact('creative_image'));
    }
    public function image_upload(Request $request, Creative_Image $creative_image)
    {
        $image = $request->file('image');
        $creative_image = Creative_Image::find($request->hidden_id);

        $img = '/storage/' . $creative_image->image;
        $mainPath = public_path();
        unlink(str_replace('\\', '/', $mainPath . $img));

        if ($request->hasFile('image')) {
            $url = 'creative\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $image->move(public_path('storage/creative'), $url);
            $creative_image['image'] = $url;
            $creative_image->save();
        }
        return redirect()->route('creative-edit');
    }

    public function destroy(Creative $creative)
    {
        //
    }
}
