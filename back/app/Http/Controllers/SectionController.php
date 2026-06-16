<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        $storageUrl = url('storage') . '/';
        
        $sections->each(function ($section) use ($storageUrl) {
            for ($i = 1; $i <= 5; $i++) {
                $imageKey = "image$i";
                if ($section->$imageKey) {
                    $section->$imageKey = $storageUrl . str_replace(['\\', 'storage/'], ['', ''], $section->$imageKey);
                }
            }
        });
        
        return response()->json($sections);
    }
    
    public function getByTitle($title, Request $request)
    {
        $decodedTitle = str_replace('-', ' ', $title);
        $section = Section::where('name', $decodedTitle)->firstOrFail();
        $storageUrl = url('storage') . '/';
        
        for ($i = 1; $i <= 5; $i++) {
            $imageKey = "image$i";
            if ($section->$imageKey) {
                $section->$imageKey = $storageUrl . str_replace(['\\', 'storage/'], ['', ''], $section->$imageKey);
            }
        }
    
        return response()->json($section);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'images'      => 'array|max:5',
            'images.*'    => 'nullable|image|max:2048',
        ]);
    
        $data = $request->only(['name', 'description']);
    
        for ($i = 0; $i < 5; $i++) {
            if ($request->hasFile("images.$i")) {
                $image = $request->file("images.$i");
                $filename = now()->format("Y-m-d_H-i") . " - " . rand(10000, 99999) . " - " . $image->getClientOriginalName();
                $image->move(public_path('storage/sections'), $filename);
                $data["image" . ($i + 1)] = 'sections/' . $filename;
            }
        }
    
        $section = Section::create($data);
        
        // Transform for response
        $storageUrl = url('storage') . '/';
        for ($i = 1; $i <= 5; $i++) {
            $imageKey = "image$i";
            if ($section->$imageKey) {
                $section->$imageKey = $storageUrl . str_replace(['\\', 'storage/'], ['', ''], $section->$imageKey);
            }
        }
        
        return response()->json($section, 201);
    }


    public function show(Section $section)
    {
        $storageUrl = url('storage') . '/';
        for ($i = 1; $i <= 5; $i++) {
            $imageKey = "image$i";
            if ($section->$imageKey) {
                $section->$imageKey = $storageUrl . str_replace(['\\', 'storage/'], ['', ''], $section->$imageKey);
            }
        }
        return response()->json($section);
    }

    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);
    
        $request->validate([
            'name'        => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'images'      => 'array|max:5',
            'images.*'    => 'nullable|image|max:2048',
        ]);
    
        $data = $request->only(['name', 'description']);
    
        for ($i = 0; $i < 5; $i++) {
            $imageKey = "image" . ($i + 1);
            if ($request->hasFile("images.$i")) {
                // New image uploaded for this slot
                $image = $request->file("images.$i");
                $filename = now()->format("Y-m-d_H-i") . " - " . rand(10000, 99999) . " - " . $image->getClientOriginalName();
                $image->move(public_path('storage/sections'), $filename);
                $data[$imageKey] = 'sections/' . $filename;
            } elseif ($request->has("existing_images.$i")) {
                // Preserve existing image for this slot
                $data[$imageKey] = $request->input("existing_images.$i");
            } else {
                // No image for this slot (or deleted)
                $data[$imageKey] = null;
            }
        }
    
        $section->update($data);
        
        // Transform for response
        $storageUrl = url('storage') . '/';
        for ($i = 1; $i <= 5; $i++) {
            $imageKey = "image$i";
            if ($section->$imageKey) {
                $section->$imageKey = $storageUrl . str_replace(['\\', 'storage/'], ['', ''], $section->$imageKey);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Section updated successfully',
            'data' => $section
        ]);
    }
    
   public function destroy($id)
    {
        $section = Section::find($id);
    
        if (!$section) {
            return response()->json([
                'status' => false,
                'message' => 'القسم غير موجود.'
            ], 404);
        }
    
        $section->delete();
    
        return response()->json([
            'status' => true,
            'message' => 'تم حذف القسم بنجاح.'
        ], 200);
    }


}
