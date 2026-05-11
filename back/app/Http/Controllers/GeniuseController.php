<?php

namespace App\Http\Controllers;

use App\Models\Geniuse;
use Illuminate\Http\Request;

class GeniuseController extends Controller
{

    public function index()
    {
        $geniuses = Geniuse::all();
    }
    public function api_index()
    {
        $geniuses = Geniuse::all();
        $geniuses->each(function ($item) {
            if ($item->image) {
                $item->image = url('storage/' . str_replace('\\', '/', $item->image));
            }
        });
        return response()->json($geniuses);
    }
    
     public function detail_index($name)
    {
        $geniuses = Geniuse::where('name', 'LIKE', '%' . str_replace('-', ' ', $name) . '%')->get();
        return view('frontsite.Geniuse_Details', compact('geniuses'));
    }

    public function create()
    {
        $geniuse = Geniuse::all();
        return view('backsite.create_geniuse', compact('geniuse'));
    }


    public function store(Request $request)
    {
        $image = $request->file('image');
        $data = $request->all();
        if ($request->hasFile('image')) {
            $url = 'geniuse\\' . date("Y-M-d H:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $request->image->move(public_path('storage/geniuse'), $url);
            $data['image'] = $url;
        }
        Geniuse::create($data);
        return redirect()->route('geniuse-post');
    }


    public function show(Geniuse $geniuse)
    {
        $geniuse = Geniuse::all();
        return view('backsite.geniuse_table', compact('geniuse'));
    }


    public function edit(Request $request, Geniuse $geniuse, $id)
    {
        // $id = Geniuse::find($request->hidden_id);
        $geniuse = Geniuse::find($id);
        // dd($geniuse);
        return view('backsite.update_geniuse', compact('geniuse'));
    }
     public function updateStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:active,inactive',
        ]);
    
        $geniuse = Geniuse::findOrFail($id);
    
        $geniuse->status = $data['status'];
        $geniuse->save();
    
        return response()->json([
            'message' => 'Status updated successfully.',
            'geniuse' => $geniuse,
        ]);
    }

    public function update(Request $request, Geniuse $geniuse)
    {
        $data = $request->validate([
            'name' => 'required',
            'details' => 'required',
        ]);
        $geniuse = Geniuse::find($request->hidden_id);
        $geniuse->name = $data['name'];
        $geniuse->details = $data['details'];
        $image = $request->file('image');
        $mainImage = $geniuse->image;
        $mainPath = public_path('storage/' . $mainImage);
        // unlink(str_replace('\\', '/', $mainPath));
        if ($request->hasFile('image')) {
            $url = 'geniuse\\' . date("Y-M-d H:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $request->image->move(public_path('storage/geniuse'), $url);
            $data['image'] = $url;
            $geniuse->image = $data['image'];
            
            if ($mainImage != null) {
            unlink(str_replace('\\', '/', $mainPath));
            }
        }

        $geniuse->save();
        return redirect()->route('geniuse-show');
    }

    public function destroy(Geniuse $geniuse, $id)
    {
        $file = Geniuse::find($id);
        $mainImage = $file->image;
        $mainPath = public_path('storage/' . $mainImage);
       
          if ($mainImage != null) {
            unlink(str_replace('\\', '/', $mainPath));
            Geniuse::destroy($id);
            }
            else{
            Geniuse::destroy($id);
            }
        return redirect()->route('geniuse-show');
    }
    
    public function api_store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'geniuse/' . now()->format('Y-m-d_H-i') . '_' . rand(1000, 9999) . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/geniuse'), $filename);
            $data['image'] = $filename;
        }

        $geniuse = Geniuse::create($data);

        if ($geniuse->image) {
            $geniuse->image = url('storage/' . str_replace('\\', '/', $geniuse->image));
        }

        return response()->json([
            'message' => 'تم انشاء البيانات بنجاح',
            'data' => $geniuse
        ], 201);
    }

    // ✅ API: Update
    public function api_update(Request $request, $id)
    {
        $geniuse = Geniuse::find($id);

        if (!$geniuse) {
            return response()->json(['message' => 'العبقري غير موجود'], 404);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($geniuse->image && file_exists(public_path('storage/' . $geniuse->image))) {
                unlink(public_path('storage/' . $geniuse->image));
            }

            $image = $request->file('image');
            $filename = 'geniuse/' . now()->format('Y-m-d_H-i') . '_' . rand(1000, 9999) . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/geniuse'), $filename);
            $data['image'] = $filename;
        }

        $geniuse->update($data);

        if ($geniuse->image) {
            $geniuse->image = url('storage/' . str_replace('\\', '/', $geniuse->image));
        }

        return response()->json([
            'message' => 'تم التحديث بنجاح',
            'data' => $geniuse
        ]);
    }

    // ✅ API: Destroy
    public function api_destroy($id)
    {
        $geniuse = Geniuse::find($id);

        if (!$geniuse) {
            return response()->json(['message' => 'العبقري غير موجود'], 404);
        }

        // Delete image file
        if ($geniuse->image && file_exists(public_path('storage/' . $geniuse->image))) {
            unlink(public_path('storage/' . $geniuse->image));
        }

        $geniuse->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

}
