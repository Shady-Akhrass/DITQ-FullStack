<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use App\Models\Geniuse;
use App\Models\Home;
use App\Models\Images;
use App\Models\News;
use App\Models\Sound;
use App\Models\Youtube;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    public function index()
    {
        $sound = Sound::all();
        $youtubes = Youtube::all();
        $geniuses = Geniuse::all();
        $homes = Home::all();
        $images = Images::all();
        $newss = News::where('status', 'active')->get();
        $donate = Donate::where('status','active')->get();
        return view('frontsite.index', compact('homes', 'images', 'newss', 'geniuses', 'youtubes', 'donate', 'sound'));
    }
    
    public function visitorsCounter()
    {
        $home = Home::first(); 
        if ($home) {
            $home->timestamps = false;
            $home->increment('visitors');
        }
        
    }
    
   public function getVisitors()
    {
        $home = Home::first();
        $visitors = $home ? $home->visitors : 0;
        return response()->json(['visitors' => $visitors]);
    }


    public function api_index()
    {
        return Cache::remember('home_api_data', 60 * 60, function () {
            $storageUrl = url('storage') . '/';
            
            $sound = Sound::all();
            $youtubes = Youtube::all();
            $geniuses = Geniuse::where('status', 'active')->get();
            $home = Home::first();
            $images = Images::where('home_id', $home->id)->get();
            $newss = News::where('status', 'active')->latest()->take(4)->get();
            $donate = Donate::where('status', 'active')->get();

            // Helper to process images
            $processImage = function ($item) use ($storageUrl) {
                if ($item->image) {
                    $item->image = $storageUrl . str_replace(['\\', 'storage/'], ['', ''], $item->image);
                }
                return $item;
            };

            $newss->transform($processImage);
            $donate->transform($processImage);
            $geniuses->transform($processImage);
            $images->transform($processImage);

            return [
                'homes' => $home ? [$home] : [], // Keep array format for frontend compatibility
                'images' => $images,
                'newss' => $newss,
                'geniuses' => $geniuses,
                'youtubes' => $youtubes,
                'donate' => $donate,
                'sound' => $sound
            ];
        });
    }


    public function create()
    {
        $home = Home::all();
        return view('backsite.create_home', compact('home'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'vision' => 'required',
            'mission' => 'required',
            'student_number' => 'required',
            'lesson_number' => 'required',
            'memorizing_number' => 'required',
            'teacher_number' => 'required',
            'course_number' => 'required',
            'camp_number' => 'required',
            'contest_number' => 'required',
            'celebration_number' => 'required',
        ]);

        $new_home = Home::create($data);
        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                $url = 'slider\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
                $ss = $image->move(public_path('storage/slider'), $url);
                Images::create([
                    'home_id' => $new_home->id,
                    'image' => $url
                ]);
            }
        }
        // dd($ss);
        return redirect()->route('home-post');
    }


    public function show(Home $home)
    {
        //
    }

    public function edit()
    {
        $home = Home::all();
        $images = Images::all();

        return view('backsite.update_home', compact('home', 'images'));
    }

    public function update(Request $request, Home $home)
    {
        $data = $request->validate([
            'vision' => 'required',
            'mission' => 'required',
            'student_number' => 'required',
            'lesson_number' => 'required',
            'memorizing_number' => 'required',
            'teacher_number' => 'required',
            'course_number' => 'required',
            'camp_number' => 'required',
            'contest_number' => 'required',
            'celebration_number' => 'required',
        ]);



        $home = Home::find($request->hidden_id);
        $home->vision = $data['vision'];
        $home->mission = $data['mission'];
        $home->student_number = $data['student_number'];
        $home->lesson_number = $data['lesson_number'];
        $home->memorizing_number = $data['memorizing_number'];
        $home->teacher_number = $data['teacher_number'];
        $home->course_number = $data['course_number'];
        $home->camp_number = $data['camp_number'];
        $home->contest_number = $data['contest_number'];
        $home->celebration_number = $data['celebration_number'];
        $home->save();
        return redirect()->route('home-edit');
    }
    public function image_edit(Request $request, $id)
    {
        $images = Images::find($id);
        return view('backsite.update_slider_image', compact('images'));
    }

    public function image_upload(Request $request, Images $images)
    {
        $image = $request->file('image');
        $images = Images::find($request->hidden_id);
        $img = '/storage/' . $images->image;
        $mainPath = public_path();
        unlink(str_replace('\\','/',$mainPath . $img));
        if ($request->hasFile('image')) {
            $url = 'slider\\' . date("Y-M-d H:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $request->image->move(public_path('storage/slider'), $url);
            $images['image'] = $url;
            $images->save();
        }
        return redirect()->route('home-edit');
    }
    
        public function api_store(Request $request)
    {
        $data = $request->validate([
            'vision' => 'required',
            'mission' => 'required',
            'student_number' => 'required',
            'lesson_number' => 'required',
            'memorizing_number' => 'required',
            'teacher_number' => 'required',
            'course_number' => 'required',
            'camp_number' => 'required',
            'contest_number' => 'required',
            'celebration_number' => 'required',
            'image.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $home = Home::create($data);

        $home = Home::create($data);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $fileName = 'slider/' . now()->format('Y-m-d_H-i') . '-' . Str::random(6) . '-' . $image->getClientOriginalName();
                $image->move(public_path('storage/slider'), $fileName);

                Images::create([
                    'home_id' => $home->id,
                    'image' => $fileName
                ]);
            }
        }

        Cache::forget('home_api_data');

        return response()->json([
            'message' => 'Home record created successfully',
            'data' => $home->load('images')
        ], 201);
    }

    public function api_update(Request $request, $id)
    {
        $data = $request->all();
    
        $home = Home::findOrFail($id);
        $home->update($data);
    
        Cache::forget('home_api_data');

        return response()->json([
            'message' => 'Home record updated successfully',
            'data' => $home
        ], 200);
    }

    public function api_image_upload(Request $request, $id)
    {
        $imageModel = Images::findOrFail($id);
    
        // Check if file is present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            // Delete old image if exists
            $oldPath = public_path('storage/' . $imageModel->image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
    
            // Save new image
            $fileName = 'slider/' . now()->format('Y-m-d_H-i') . '-' . Str::random(6) . '-' . $image->getClientOriginalName();
            $image->move(public_path('storage/slider'), $fileName);
    
            // Update DB
            $imageModel->image = $fileName;
            $imageModel->save();
    
            Cache::forget('home_api_data');

            return response()->json([
                'message' => 'Image updated successfully',
                'data' => $imageModel
            ], 200);
        }
    
        return response()->json([
            'message' => 'No image uploaded'
        ], 400);
    }

    public function api_image_store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:10240'
        ]);

        if (Images::count() >= 3) {
            return response()->json([
                'message' => 'عفواً، لا يمكن إضافة أكثر من 3 صور في شريط العرض. يرجى استبدال إحدى الصور الموجودة.'
            ], 422);
        }

        $home = Home::first() ?: Home::create([
            'vision' => 'Default Vision',
            'mission' => 'Default Mission',
            'student_number' => '0',
            'teacher_number' => '0',
            'course_number' => '0',
            'memorizing_number' => '0',
            'contest_number' => '0',
            'camp_number' => '0',
            'lesson_number' => '0',
            'celebration_number' => '0',
            'visitors' => 0
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = 'slider/' . now()->format('Y-m-d_H-i') . '-' . Str::random(6) . '-' . $image->getClientOriginalName();
            $image->move(public_path('storage/slider'), $fileName);

            $newImage = Images::create([
                'home_id' => $home->id,
                'image' => $fileName
            ]);

            Cache::forget('home_api_data');

            return response()->json([
                'message' => 'Image added successfully',
                'data' => $newImage
            ], 201);
        }

        return response()->json(['message' => 'No image uploaded'], 400);
    }

    public function api_image_destroy($id)
    {
        $image = Images::findOrFail($id);
        
        $filePath = public_path('storage/' . $image->image);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $image->delete();

        Cache::forget('home_api_data');

        return response()->json([
            'message' => 'Image deleted successfully'
        ], 200);
    }
    public function destroy(Home $home)
    {
        //
    }
}
