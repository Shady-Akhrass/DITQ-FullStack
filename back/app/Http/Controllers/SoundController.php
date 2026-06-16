<?php

namespace App\Http\Controllers;

use App\Models\Sound;
use Illuminate\Http\Request;

class SoundController extends Controller
{

    public function index()
    {
    }

    public function create()
    {
        $sound = Sound::all();
        return view('backsite.create_sound', compact('sound'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        Sound::create($data);
        return redirect()->route('sound-post');
    }
    public function show(Sound $sound)
    {
    }

    public function edit(Sound $sound)
    {
        $sound = Sound::all();
        return view('backsite.update_sound', compact('sound'));
    }

 
    public function update(Request $request, Sound $sound)
    {
        $data = $request->all();
        $sound = Sound::find($request->hidden_id);
        $sound->main = $data['main'];
        $sound->name = $data['name'];
        $sound->link = $data['link'];
        $sound->title = $data['title'];
        $sound->playlist = $data['playlist'];


        $sound->save();
        return redirect()->route('sound-edit');
    }
    
    
    
    public function api_store(Request $request)
    {
        $validated = $request->validate([
            'main' => 'required|string',
            'name' => 'required|string',
            'link' => 'required|url',
            'title' => 'required|string',
            'playlist' => 'required|string',
        ]);
    
        $sound = Sound::create($validated);
    
        return response()->json([
            'message' => 'Sound created successfully',
            'data' => $sound
        ], 201);
    }


    public function api_update(Request $request, $id)
    {
        $validated = $request->validate([
            'main' => 'required|string',
            'name' => 'required|string',
            'link' => 'required|url',
            'title' => 'required|string',
            'playlist' => 'required|string',
        ]);
    
        $sound = Sound::findOrFail($id);
    
        $sound->update($validated);
    
        return response()->json([
            'message' => 'Sound updated successfully',
            'data' => $sound
        ], 200);
    }

    public function destroy(Sound $sound)
    {
    }
}
