<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Activity_Image;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function index()
    {
        $activity = Activity::all();
        $activities_images = Activity_Image::all();
        return view('frontsite.ActivitySection', compact('activity', 'activities_images'));
    }
    
    public function api_index()
    {
        $activities = Activity::all();
        $activities_images = Activity_Image::all();
    
        return response()->json([
            'activities' => $activities,
            'activities_images' => $activities_images,
        ], 200); 
    }

    public function create()
    {
        $activity = Activity::all();
        return view('backsite.create_activity', compact('activity'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'about' => 'required',

        ]);

        $new_creative = Activity::create($data);
        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                $url = 'activity\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
                $image->move(public_path('storage/activity'), $url);
                Activity_Image::create([
                    'activity_id' => $new_creative->id,
                    'image' => $url
                ]);
            }
        }
        return redirect()->route('activity-post');
    }


    public function show(Activity $activity)
    {
        //
    }

    public function edit(Activity $activity)
    {
        $activity = Activity::all();
        $activity_image = Activity_Image::all();
        return view("backsite.update_activity", compact('activity', 'activity_image'));
    }


    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'about' => 'required',
        ]);
        $activity = Activity::find($request->hidden_id);
        $activity->about = $data['about'];
        $activity->save();
        return redirect()->route('activity-edit');
    }
    public function image_edit(Request $request, $id)
    {
        $activity_image = Activity_Image::find($id);
        return view('backsite.update_activity_image', compact('activity_image'));
    }
    public function image_upload(Request $request, Activity_Image $activity_image)
    {
        $image = $request->file('image');
        $activity_image = Activity_Image::find($request->hidden_id);
        $img = '/storage/' . $activity_image->image;
        $mainPath = public_path();
        unlink(str_replace('\\', '/', $mainPath . $img));
        if ($request->hasFile('image')) {
            $url = 'activity\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $image->move(public_path('storage/activity'), $url);
            $activity_image['image'] = $url;
            $activity_image->save();
        }
        return redirect()->route('activity-edit');
    }

    public function destroy(Activity $activity)
    {
        //
    }
}
