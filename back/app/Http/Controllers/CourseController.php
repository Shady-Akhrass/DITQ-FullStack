<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_Image;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::all();
        $course_images = Course_Image::all();
        return view('frontsite.CoursesSection', compact('courses', 'course_images'));
    }
    
        public function api_index()
    {
        $courses = Course::all();
        $course_images = Course_Image::all();
    
        return response()->json([
            'courses' => $courses,
            'course_images' => $course_images,
        ], 200); 
    }

    public function create()
    {
        $course = Course::all();
        return view('backsite.create_course', compact('course'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'about' => 'required',

        ]);

        $new_course = Course::create($data);
        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                $url = 'course\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
                $image->move(public_path('storage/course'), $url);
                Course_Image::create([
                    'course_id' => $new_course->id,
                    'image' => $url
                ]);
            }
        }
        return redirect()->route('course-post');
    }

    public function show(Course $course)
    {
        //
    }


    public function edit(Course $course)
    {
        $course = Course::all();
        $course_image = Course_Image::all();
        return view("backsite.update_course", compact('course', 'course_image'));
    }


    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'about' => 'required',
        ]);
        $course = Course::find($request->hidden_id);
        $course->about = $data['about'];
        $course->save();
        return redirect()->route('course-edit');
    }
    public function image_edit(Request $request, $id)
    {
        $course_image = Course_Image::find($id);
        return view('backsite.update_course_image', compact('course_image'));
    }
    public function image_upload(Request $request, Course_Image $course_image)
    {
        $image = $request->file('image');
        $course_image = Course_Image::find($request->hidden_id);

        $img = '/storage/' . $course_image->image;
        $mainPath = public_path();
        unlink(str_replace('\\', '/', $mainPath . $img));
        if ($request->hasFile('image')) {
            $url = 'course\\' . date("Y-M-dH:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $image->move(public_path('storage/course'), $url);
            $course_image['image'] = $url;
            $course_image->save();
        }
        return redirect()->route('course-edit');
    }

    public function destroy(Course $course)
    {
        //
    }
}
