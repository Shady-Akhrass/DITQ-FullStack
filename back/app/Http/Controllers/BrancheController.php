<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use Illuminate\Http\Request;

class BrancheController extends Controller
{

    public function index()
    {
        return view('frontsite.branches');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Branche $branche)
    {
        //
    }


    public function edit(Branche $branche)
    {
        //
    }


    public function update(Request $request, Branche $branche)
    {
        //
    }


    public function destroy(Branche $branche)
    {
        //
    }
}
