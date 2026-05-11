<?php

namespace App\Http\Controllers;

use App\Models\Diwan;
use App\Models\Diwan_Image;
use Illuminate\Http\Request;

class DiwanController extends Controller
{

    public function index()
    {
        $diwans = Diwan::all();
        $diwan_images = Diwan_Image::all();
        return view('frontsite.Diwan_department', compact('diwans', 'diwan_images'));
    }
    
    public function api_index()
    {
        // Fetch all diwans and their related images
        $diwans = Diwan::all();
        $diwan_images = Diwan_Image::all();
    
        // Return data as JSON
        return response()->json([
            'diwans' => $diwans,
            'diwan_images' => $diwan_images,
        ], 200); // HTTP status code 200 indicates success
    }
    
    public function create()
    {
        $diwan = Diwan::all();
        return view('backsite.create_diwan', compact('diwan'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'about' => 'required',

        ]);

        $new_diwan = Diwan::create($data);
        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                $url = 'diwan\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
                $image->move(public_path('storage/diwan'), $url);
                Diwan_Image::create([
                    'diwan_id' => $new_diwan->id,
                    'image' => $url
                ]);
            }
        }
        return redirect()->route('diwan-edit');
    }


    public function show(Diwan $diwan)
    {
        //
    }

    public function edit(Diwan $diwan)
    {
        $diwan = Diwan::all();
        $diwan_image = Diwan_Image::all();
        return view("backsite.update_diwan", compact('diwan', 'diwan_image'));
    }


    public function update(Request $request, Diwan $diwan)
    {
        $data = $request->validate([
            'about' => 'required',
        ]);
        $diwan = Diwan::find($request->hidden_id);
        $diwan->about = $data['about'];
        $diwan->save();
        return redirect()->route('diwan-post');
    }
    public function image_edit(Request $request, $id)
    {
        $diwan_image = Diwan_Image::find($id);
        return view('backsite.update_diwan_image', compact('diwan_image'));
    }
    public function image_upload(Request $request, Diwan_Image $diwan_image)
    {
        $image = $request->file('image');
        $diwan_image = Diwan_Image::find($request->hidden_id);

        $img = '/storage/' . $diwan_image->image;
        $mainPath = public_path();
        unlink(str_replace('\\', '/', $mainPath . $img));
        if ($request->hasFile('image')) {
            $url = 'diwan\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $image->move(public_path('storage/diwan'), $url);
            $diwan_image['image'] = $url;
            $diwan_image->save();
        }
        return redirect()->route('diwan-edit');
    }

    public function destroy(Diwan $diwan)
    {
        //
    }
}
