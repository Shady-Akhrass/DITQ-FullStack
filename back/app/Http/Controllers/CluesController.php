<?php

namespace App\Http\Controllers;

use App\Models\Clues;
use Illuminate\Http\Request;

class CluesController extends Controller
{
    public function index()
    {
        $clues = Clues::all();
        return view('frontsite.clues', compact('clues'));
    }
    public function api_index()
    {
        $clues = Clues::all();
        $clues->each(function ($item) {
            if ($item->pdf) {
                $item->pdf = url('storage/' . str_replace('\\', '/', $item->pdf));
            }
        });
        return response()->json([
            'clues' => $clues,
        ], 200); 
    }
    public function create()
    {
        $clues = Clues::all();
        return view('backsite.create_clues', compact('clues'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf',
        ]);
        $pdf = $request->file('pdf');
        if ($request->hasFile('pdf')) {
            $url = 'clues\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $pdf->getClientOriginalName();
            $pdf->move(public_path('storage/clues'), $url);
            $data['pdf'] = $url;
        }
        Clues::create($data);
        return redirect()->route('clues-post');
    }
    public function edit(Clues $clues)
    {
        $clues = Clues::all();
        return view('backsite.update_clues', compact('clues'));
    }


    public function update(Request $request, Clues $clues)
    {

        $clues = Clues::find($request->hidden_id);
        $pdf = $request->file('pdf');

        $img = '/storage/' . $clues->pdf;
        $mainPath = public_path();
        unlink(str_replace('\\', '/', $mainPath . $img));

        if ($request->hasFile('pdf')) {
            $url = 'clues\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $pdf->getClientOriginalName();
            $pdf->move(public_path('storage/clues'), $url);
            $clues['pdf'] = $url;
            $clues->save();
        }

        return redirect()->route('clues-edit');
    }
    public function api_store(Request $request)
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);
    
        $data = [];
    
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $filename = date("Y-m-d_H-i") . " - " . rand(1000, 9999) . " - " . $pdf->getClientOriginalName();
            $path = 'clues/' . $filename;
            $pdf->move(public_path('storage/clues'), $filename);
            $data['pdf'] = $path;
        }
    
        $clue = Clues::create($data);
    
        if ($clue->pdf) {
            $clue->pdf = url('storage/' . str_replace('\\', '/', $clue->pdf));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'PDF uploaded successfully',
            'data' => $clue
        ]);
        
    }
   public function api_update(Request $request, $id)
    {
        try {
            $clue = Clues::findOrFail($id);
    
            if ($request->hasFile('pdf')) {
                $pdf = $request->file('pdf');
    
                // Delete old PDF if exists
                if ($clue->pdf) {
                    $oldPath = public_path('storage/' . str_replace('\\', '/', $clue->pdf));
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
    
                // Generate unique filename
                $filename = date("Y-m-d_H-i") . " - " . rand(1000, 9999) . " - " . $pdf->getClientOriginalName();
                $path = 'clues/' . $filename;
                
                // Move file to storage
                $pdf->move(public_path('storage/clues'), $filename);
                
                // Update database
                $clue->pdf = $path;
                $clue->save();
            }
    
            if ($clue->pdf) {
                $clue->pdf = url('storage/' . str_replace('\\', '/', $clue->pdf));
            }

            return response()->json([
                'status' => 'success',
                'message' => 'PDF updated successfully',
                'data' => $clue
            ]);
    
        } catch (\Exception $e) {
            // Log the detailed error for debugging
            \Log::error('Failed to update PDF: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'هناك خطأ في البيانات الخاصة في ال api key'
            ], 500);
        }
    }

}
