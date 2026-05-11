<?php

namespace App\Http\Controllers;

use App\Models\Youtube;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{

    public function index()
    {
    }

    public function create()
    {
        $youtube = Youtube::all();
        return view('backsite.create_youtube', compact('youtube'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $main = $request->main;
        $secondary1 = $request->secondary1;
        $secondary2 = $request->secondary2;
        $string = 'embed/';

        if (!str_contains($main, "www")) {
            $main = substr_replace($main, 'www.', 8, 0);
        }
        if (!str_contains($secondary1, "www")) {
            $secondary1 = substr_replace($secondary1, 'www.', 8, 0);
        }
        if (!str_contains($secondary2, "www")) {
            $secondary2 = substr_replace($secondary2, 'www.', 8, 0);
        }

        if (str_contains($main, "youtu.be")) {

            if (!str_contains($main, "embed")) {
                $main = str_replace('youtu.be', 'youtube.com', $main);
                $main = substr_replace($main, $string, 24, 0);
            } else {
                $main = str_replace('youtu.be', 'youtube.com', $main);
            }
        } elseif (str_contains($main, "youtube.com") and !str_contains($main, "embed")) {
            $main = substr_replace($main, $string, 24, 0);
        } else {
            $main = $request->main;
        }

        if (str_contains($secondary1, "youtu.be")) {

            if (!str_contains($secondary1, "embed")) {
                $secondary1 = str_replace('youtu.be', 'youtube.com', $secondary1);
                $secondary1 = substr_replace($secondary1, $string, 24, 0);
            } else {
                $secondary1 = str_replace('youtu.be', 'youtube.com', $secondary1);
            }
        } elseif (str_contains($secondary1, "youtube.com") and !str_contains($secondary1, "embed")) {
            $secondary1 = substr_replace($secondary1, $string, 24, 0);
        } else {
            $secondary1 = $request->secondary1;
        }

        if (str_contains($secondary2, "youtu.be")) {

            if (!str_contains($secondary2, "embed")) {
                $secondary2 = str_replace('youtu.be', 'youtube.com', $secondary2);
                $secondary2 = substr_replace($secondary2, $string, 24, 0);
            } else {
                $secondary2 = str_replace('youtu.be', 'youtube.com', $secondary2);
            }
        } elseif (str_contains($secondary2, "youtube.com") and !str_contains($secondary2, "embed")) {
            $secondary2 = substr_replace($secondary2, $string, 24, 0);
        } else {
            $secondary2 = $request->secondary2;
        }
        $data['main'] = $main;
        $data['secondary1'] = $secondary1;
        $data['secondary2'] = $secondary2;
        // dd($main, $secondary1, $secondary2);
        Youtube::create($data);
        return redirect()->route('youtube-post');
    }
    public function show(Youtube $youtube)
    {
    }

    public function edit(Youtube $youtube)
    {
        $youtube = Youtube::all();
        return view('backsite.update_youtube', compact('youtube'));
    }


    public function update(Request $request, Youtube $youtube)
    {
        $data = $request->validate([
            'main' => 'required',
            'secondary1' => 'required',
            'secondary2' => 'required',

        ]);
        $youtube = Youtube::find($request->hidden_id);
        $main = $data['main'];
        $secondary1 = $data['secondary1'];
        $secondary2 = $data['secondary2'];
        $string = 'embed';

        if (!str_contains($main, "www")) {
            $main = substr_replace($main, 'www.', 8, 0);
        }
        if (!str_contains($secondary1, "www")) {
            $secondary1 = substr_replace($secondary1, 'www.', 8, 0);
        }
        if (!str_contains($secondary2, "www")) {
            $secondary2 = substr_replace($secondary2, 'www.', 8, 0);
        }

        if (str_contains($main, "youtu.be")) {

            if (!str_contains($main, "embed")) {
                $main = str_replace('youtu.be', 'youtube.com', $main);
                $main = substr_replace($main, $string . "/", 24, 0);
            } else {
                $main = str_replace('youtu.be', 'youtube.com', $main);
            }
        } elseif (str_contains($main, "youtube.com") and !str_contains($main, "embed")) {
            $main = substr_replace($main, $string . "/", 24, 0);
        } else {
            $main = $request->main;
        }

        if (str_contains($secondary1, "youtu.be")) {

            if (!str_contains($secondary1, "embed")) {
                $secondary1 = str_replace('youtu.be', 'youtube.com', $secondary1);
                $secondary1 = substr_replace($secondary1, $string . "/", 24, 0);
            } else {
                $secondary1 = str_replace('youtu.be', 'youtube.com', $secondary1);
            }
        } elseif (str_contains($secondary1, "youtube.com") and !str_contains($secondary1, "embed")) {
            $secondary1 = substr_replace($secondary1, $string . "/", 24, 0);
        } else {
            $secondary1 = $request->secondary1;
        }

        if (str_contains($secondary2, "youtu.be")) {

            if (!str_contains($secondary2, "embed")) {
                $secondary2 = str_replace('youtu.be', 'youtube.com', $secondary2);
                $secondary2 = substr_replace($secondary2, $string . "/", 24, 0);
            } else {
                $secondary2 = str_replace('youtu.be', 'youtube.com', $secondary2);
            }
        } elseif (str_contains($secondary2, "youtube.com") and !str_contains($secondary2, "embed")) {
            $secondary2 = substr_replace($secondary2, $string . "/", 24, 0);
        } else {
            $secondary2 = $request->secondary2;
        }

        $youtube->main = $main;
        $youtube->secondary1 = $secondary1;
        $youtube->secondary2 = $secondary2;

        $youtube->save();
        return redirect()->route('youtube-edit');
    }
    private function formatYoutubeUrl(string $url): string
    {
        $string = 'embed/';
        
        if (!str_contains($url, "www")) {
            $url = substr_replace($url, 'www.', 8, 0);
        }
    
        if (str_contains($url, "youtu.be")) {
            $url = str_replace('youtu.be', 'youtube.com', $url);
            if (!str_contains($url, "embed")) {
                $url = substr_replace($url, $string, 24, 0);
            }
        } elseif (str_contains($url, "youtube.com") && !str_contains($url, "embed")) {
            $url = substr_replace($url, $string, 24, 0);
        }
    
        return $url;
    }
    public function api_store(Request $request)
    {
        $validated = $request->validate([
            'main' => 'required|string',
            'secondary1' => 'required|string',
            'secondary2' => 'required|string',
        ]);
    
        $validated['main'] = $this->formatYoutubeUrl($validated['main']);
        $validated['secondary1'] = $this->formatYoutubeUrl($validated['secondary1']);
        $validated['secondary2'] = $this->formatYoutubeUrl($validated['secondary2']);
    
        $youtube = Youtube::create($validated);
    
        return response()->json([
            'message' => 'Video created successfully',
            'data' => $youtube
        ], 201);
    }

    public function api_update(Request $request, $id)
    {
        $validated = $request->validate([
            'main' => 'required|string',
            'secondary1' => 'required|string',
            'secondary2' => 'required|string',
        ]);
    
        $youtube = Youtube::findOrFail($id);
    
        $youtube->main = $this->formatYoutubeUrl($validated['main']);
        $youtube->secondary1 = $this->formatYoutubeUrl($validated['secondary1']);
        $youtube->secondary2 = $this->formatYoutubeUrl($validated['secondary2']);
    
        $youtube->save();
    
        return response()->json([
            'message' => 'Video updated successfully',
            'data' => $youtube
        ], 200);
    }


    public function destroy(Youtube $youtube)
    {
    }
}