<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Speech;
use Illuminate\Http\Request;

class SpeechController extends Controller
{

    public function index()
    {
        $speechs = Speech::all();
        $director = Director::all();
        return view("frontsite.President's_speech", compact('speechs', 'director'));
    }
    public function api_index()
    {
        $speechs = Speech::all();
        $directors = Director::all();

        return response()->json([
            'speechs' => $speechs,
            'directors' => $directors
        ]);
    }

    public function create()
    {
        $speech = Speech::all();
        return view('backsite.create_speech',compact('speech'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        Speech::create($data);
        return redirect()->route('speech-post');
    }
    
    public function api_store(Request $request)
    {
        $data = $request->validate([
            'speech' => 'required|string',
        ]);
    
        $speech = Speech::create($data);
    
        return response()->json([
            'success' => true,
            'message' => 'Speech created successfully.',
            'data' => $speech
        ], 201); // 201 = Created
    }



    public function show(Speech $speech)
    {
        //
    }


    public function edit(Speech $speech)
    {
        $speechs = Speech::all();
        return view('backsite.update_speech', compact('speechs'));
    }


    public function update(Request $request, Speech $speech)
    {
        $data = $request->validate([
            'speech' => 'required',

        ]);
        $speech = Speech::find($request->hidden_id);
        $speech->speech = $data['speech'];
        $speech->save();
        return redirect()->route('speech-edit');

    }

    public function api_update(Request $request, $id)
    {
        $data = $request->validate([
            'speech' => 'required|string',
        ]);
    
        $speech = Speech::find($id);
    
        if (!$speech) {
            return response()->json([
                'success' => false,
                'message' => 'Speech not found.'
            ], 404);
        }
    
        $speech->speech = $data['speech'];
        $speech->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Speech updated successfully.',
            'data' => $speech
        ], 200);
    }

    public function destroy(Speech $speech)
    {
        //
    }
}
