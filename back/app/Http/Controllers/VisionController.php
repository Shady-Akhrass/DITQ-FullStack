<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\vision;
use Illuminate\Http\Request;

class VisionController extends Controller
{

    public function index()
    {
        $visions = Home::all();
        return view('frontsite.vision', compact('visions'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(vision $vision)
    {
        //
    }


    public function edit(vision $vision)
    {
        //
    }

    public function update(Request $request, vision $vision)
    {
        //
    }


    public function destroy(vision $vision)
    {
        //
    }
}
