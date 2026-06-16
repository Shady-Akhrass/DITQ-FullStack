<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use function PHPUnit\Framework\fileExists;

class NewsController extends Controller
{
    public function index()
    {
        $newss = News::all();
        //$chunks = array_chunk($newss, 4);
        return view('frontsite.news', compact('newss'));
    }
    public function api_index()
    {
        
        $newss = News::where('status', 'active')->get();
         $newss->each(function ($item) {
            $item->image = url('storage/' . str_replace('\\', '/', $item->image));
        });
        return response()->json($newss);
    }
    
    public function api_index_admin()
    {
        $newss = News::all();
    
        $newss->each(function ($item) {
            $item->image = url('storage/' . str_replace('\\', '/', $item->image));
        });
    
        return response()->json($newss);
    }
    
     public function news_detail($idOrTitle)
    {
        if (is_numeric($idOrTitle)) {
            $news = News::findOrFail($idOrTitle);
            $titleSlug = str_replace(' ', '-', $news->title);
            return redirect()->route('news_detail', ['idOrTitle' => $titleSlug]);
        } else {
            $news = News::where('title', 'LIKE', '%' . str_replace('-', ' ', $idOrTitle) . '%')->firstOrFail();
        }
    
        return view('frontsite.news-one-details', ['newss' => [$news]]);
    }
    public function api_news_detail_by_id($id)
    {
        try {
            $news = News::findOrFail($id);
    
            // Process the image URL
            $news->image = url('storage/' . str_replace('\\', '/', $news->image));
    
            // Process subphotos if they exist
            if ($news->subphotos1) {
                $news->subphotos1 = url('storage/' . str_replace('\\', '/', $news->subphotos1));
            }
    
            return response()->json($news);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'News article not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the news'], 500);
        }
    }

    public function api_news_detail($idOrTitle)
    {
        try {
            if (is_numeric($idOrTitle)) {
                $news = News::findOrFail($idOrTitle);
                $this->visitorsCounter($idOrTitle);
                $titleSlug = str_replace(' ', '-', $news->title);
                return redirect()->route('news_detail', ['idOrTitle' => $titleSlug]);
            } else {
                $this->visitorsCounter($idOrTitle);
                // Clean up the title search by replacing dashes with spaces
                $searchTitle = str_replace('-', ' ', $idOrTitle);
                
                // Find the news article
                $news = News::where('title', 'LIKE', '%' . $searchTitle . '%')->firstOrFail();
                
                // Process the image URL
                $news->image = url('storage/' . str_replace('\\', '/', $news->image));
                
                // Process subphotos if they exist
                if ($news->subphotos1) {
                    $news->subphotos1 = url('storage/' . str_replace('\\', '/', $news->subphotos1));
                }
            }
            
            return response()->json($news);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'News article not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the news'], 500);
        }
    }

    public function search(Request $request)
    {
        // $search_text = $_GET['query'];
        if ($request->search) {
            $news = News::where('title', 'LIKE', '%' . $request->search . '%')->get();
            // $news = DB::table('news')->where('title', 'LIKE', '%'.$request->search.'%')->get();
            return view('frontsite.search', compact('news'));
        } elseif (trim($request->search) == "") {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    
   public function search_api(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'search' => 'required|string|min:1',
        ]);
    
        // Return validation errors
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 422);
        }
    
        // Search for news articles
        $news = News::where('title', 'LIKE', '%' . $request->search . '%')->get();
    
        // Return response
        if ($news->isEmpty()) {
            return response()->json(["message" => "No results found"], 404);
        }
    
        return response()->json(["news" => $news], 200);
    }

    public function create()
    {
        $news = new news();
        return view('backsite.post', ['news' => $news]);
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $subphotos1 = $request->file('subphotos1');

        $data = $request->all();
        if ($request->hasFile('image')) {
            $url = 'images\\' . date("Y-M-d H:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $url2 = 'subphotos1\\' . date("Y-M-d H:i", time()) . " - " . rand(00000, 9999) . " - " . $subphotos1->getClientOriginalName();
            $request->image->move(public_path('storage/images'), $url);
            $request->subphotos1->move(public_path('storage/subphotos1'), $url2);
            $data['image'] =  $url;
            $data['subphotos1'] = $url2;

            // dd($nn,$url2);

        }
    
        $news = News::create($data);
        // dd($data);
        return redirect()->route('news-show')->with('message', 'a news added successfully');
    }
    
    public function storeApi(Request $request)
    {
        // Validate request data including unique title check
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:news,title',
            'object' => 'required|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'subphotos1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['title', 'object', 'status']); // Only get the fields we need
        
        // Handle main image if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $url = 'images\\' . date("Y-M-d H:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $image->move(public_path('storage/images'), $url);
            $data['image'] = $url;
        } else {
            // Set default image if not provided
            $data['image'] = null;
        }
        
        // Handle sub photo if provided
        if ($request->hasFile('subphotos1')) {
            $subphotos1 = $request->file('subphotos1');
            $url2 = 'subphotos1\\' . date("Y-M-d H:i", time()) . " - " . rand(00000, 9999) . " - " . $subphotos1->getClientOriginalName();
            $subphotos1->move(public_path('storage/subphotos1'), $url2);
            $data['subphotos1'] = $url2;
        } else {
            // Set default sub photo if not provided
            $data['subphotos1'] = null;
        }
    
        try {
            $news = News::create($data);
        } catch (\Exception $e) {
            // Handle database errors
            return response()->json([
                'message' => 'Failed to create news: ' . $e->getMessage(),
                'error' => 'Database error occurred'
            ], 500);
        }
        Cache::forget('home_api_data');
        return response()->json([
            "message" => 'an article added successfully',
            "news" => $news
        ], 201);
    }
   public function show(News $news)
    {
        $newss = News::orderBy('created_at', 'desc')->paginate(10);
        return view('backsite.news_table', compact('newss'));
    }

    public function edit(News $news, $id)
    {
        $newss = News::find($id);
        return view('backsite.update_news', compact('newss'));
    }

    public function updateApi(Request $request, $id) {
        // Debug: Log the ID being used
        \Log::info('Updating news ID: ' . $id);
        \Log::info('Request data: ' . json_encode($request->all()));
        \Log::info('Request title: ' . $request->title);
        
        // Validate required fields - temporarily removed unique validation for debugging
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'object' => 'required|string|max:5000',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'subphotos1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed: ' . json_encode($validator->errors()));
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Find the news by ID
        $news = News::findOrFail($id);
    
        // Update basic fields
        $news->title = $request->title;
        $news->object = $request->object;
        if (isset($request->status)) {
            $news->status = $request->status;
        }
    
        // Store old image paths
        $mainImage = $news->image;
        $subImage1 = $news->subphotos1;
        $mainPath = public_path('storage/' . str_replace('\\', '/', $mainImage));
        $sub1Path = public_path('storage/' . str_replace('\\', '/', $subImage1));
    
        // Handle image update
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $url = 'images\\' . now()->format("Y-m-d_H-i") . "-" . rand(1000, 9999) . "-" . $image->getClientOriginalName();
            $image->move(public_path('storage/images'), $url);
            $news->image = $url;
            if ($mainImage && file_exists($mainPath)) {
                unlink($mainPath);
            }
        }
    
        // Handle subphotos1 update
        if ($request->hasFile('subphotos1')) {
            $subphotos1 = $request->file('subphotos1');
            $url2 = 'subphotos1\\' . now()->format("Y-m-d_H-i") . "-" . rand(1000, 9999) . "-" . $subphotos1->getClientOriginalName();
            $subphotos1->move(public_path('storage/subphotos1'), $url2);
            $news->subphotos1 = $url2;
            if ($subImage1 && file_exists($sub1Path)) {
                unlink($sub1Path);
            }
        }
    
        // Save the updated record
        $news->save();
        Cache::forget('home_api_data');
        return response()->json([
            'message' => 'News updated successfully',
            'news' => $news
        ]);
    }
    public function updateStatus(Request $request, $id)
    {
        // Validate the incoming status value
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Find the news item or fail
        $news = News::findOrFail($id);
        
        // Check if status is actually changing to prevent unnecessary updates
        if ($news->status === $request->status) {
            return response()->json([
                'message' => 'Status is already the same.',
                'news' => $news
            ]);
        }
    
        // Update the status
        $news->status = $request->status;
        $news->save();
        Cache::forget('home_api_data');
    
        // Return success response
        return response()->json([
            'message' => 'Status updated successfully.',
            'news' => $news,
        ]);
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required',
            'object' => 'required'
            // 'image' => 'required',
            // 'subphotos1' => 'required',
            // 'subphotos2' => 'required',
            // 'subphotos3' => 'required'


        ]);
        $news = News::find($request->hidden_id);
        $news->title = $data['title'];
        $news->object = $data['object'];

        $image = $request->file('image');
        $subphotos1 = $request->file('subphotos1');

        $mainImage = $news->image;
        $subImage1 = $news->subphotos1;
        $mainPath = public_path('storage/' . $mainImage);
        $sub1Path = public_path('storage/' . $subImage1);
       
       

        if ($request->hasFile('image')) {


            $url = 'images\\' . date("Y-M-d H:i", time()) . "-" . rand(00000, 9999) . "-" . $image->getClientOriginalName();
            $request->image->move(public_path('storage/images'), $url);
            $data['image'] = $url;
            $news->image = $data['image'];
            
             if ($mainImage != null) {
             unlink(str_replace('\\', '/', $mainPath));
    }
        }
        if ($request->hasFile('subphotos1')) {
            $url2 = 'subphotos1\\' . date("Y-M-d H:i", time()) . "-" . rand(00000, 9999) . "-" . $subphotos1->getClientOriginalName();
            $request->subphotos1->move(public_path('storage/subphotos1'), $url2);
            $data['subphotos1'] = $url2;
            $news->subphotos1 = $data['subphotos1'];
            
             if ($subImage1 != null) {
             unlink(str_replace('\\', '/', $sub1Path));
    }
        }



        $news->save();
        return redirect()->route('news-show');
    }



    public function destroy($id, Request $request)
    {
        $file = News::find($id);
        $mainImage = $file->image;
        $subImage1 = $file->subphotos1;
        $mainPath = public_path('storage/' . $mainImage);
        $sub1Path = public_path('storage/' . $subImage1);
        unlink(str_replace('\\', '/', $mainPath));
        unlink(str_replace('\\', '/', $sub1Path));
        News::destroy($id);
        return redirect()->route('news-show');
    }
   private function visitorsCounter($idOrTitle)
    {
        if (is_numeric($idOrTitle)) {
            $news = News::find($idOrTitle);
        } else {
            $searchTitle = str_replace('-', ' ', $idOrTitle);
            $news = News::where('title', 'LIKE', '%' . $searchTitle . '%')->first();
        }
    
        if ($news) {
            $news->timestamps = false;
            $news->increment('visitors');
        }
    }


    public function deleteApi($id, Request $request)
    {
        $file = News::find($id);
    
        if (!$file) {
            return response()->json(['message' => 'News not found.'], 404);
        }
    
        try {
            // Paths to main and sub images
            $mainPath = public_path('storage/' . str_replace('\\', '/', $file->image));
            $sub1Path = public_path('storage/' . str_replace('\\', '/', $file->subphotos1));
        
            // Delete main image if exists
            if ($file->image && file_exists($mainPath)) {
                unlink($mainPath);
            }
        
            // Delete sub image if exists
            if ($file->subphotos1 && file_exists($sub1Path)) {
                unlink($sub1Path);
            }
        
            // Delete the news record
            $file->delete();
            Cache::forget('home_api_data');
            return response()->json([
                'message' => 'News deleted successfully.',
                'news_id' => $id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete news: ' . $e->getMessage()
            ], 500);
        }
    }

}
