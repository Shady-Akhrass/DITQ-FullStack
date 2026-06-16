<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventImage;
use App\Models\EventComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     * Accessible by public and filtered by section.
     */
    public function index(Request $request)
    {
        $query = Event::with(['images', 'comments' => function($q) {
            $q->where('is_approved', true);
        }]);

        if ($request->has('section_id')) {
            $query->where('section_id', $request->section_id);
        }

        // Public index only shows active events
        if (!$request->user()) {
            $query->where('status', 'active');
        }

        $events = $query->latest()->get();

        $events->each(function ($event) {
            $event->images->each(function ($image) {
                $image->path = url('storage/' . str_replace('\\', '/', $image->path));
            });
        });

        return response()->json($events);
    }

    /**
     * Display a listing of events for admin (all events regardless of status).
     */
    public function adminIndex(Request $request)
    {
        $query = Event::with(['images', 'comments' => function($q) {
            $q->where('is_approved', true);
        }]);

        if ($request->has('section_id')) {
            $query->where('section_id', $request->section_id);
        }

        $events = $query->latest()->get();

        $events->each(function ($event) {
            $event->images->each(function ($image) {
                $image->path = url('storage/' . str_replace('\\', '/', $image->path));
            });
        });

        return response()->json($events);
    }

    /**
     * Display the specified event.
     */
    public function show($id)
    {
        $query = Event::with(['images', 'comments' => function($q) {
            $q->where('is_approved', true);
        }]);

        if (is_numeric($id)) {
            $event = $query->findOrFail($id);
        } else {
            $title = str_replace('-', ' ', $id);
            $event = $query->where('title', 'LIKE', '%' . $title . '%')->firstOrFail();
        }

        $event->images->each(function ($image) {
            $image->path = url('storage/' . str_replace('\\', '/', $image->path));
        });

        return response()->json($event);
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_id' => 'required|exists:sections,id',
            'title'      => 'required|string|max:255',
            'details'    => 'nullable|string',
            'status'     => 'nullable|in:active,inactive',
            'images'     => 'nullable|array',
            'images.*'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $event = Event::create($request->only(['section_id', 'title', 'details', 'status']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = now()->format("Y-m-d_H-i") . "-" . rand(10000, 99999) . "-" . $image->getClientOriginalName();
                $image->move(public_path('storage/events'), $filename);
                
                EventImage::create([
                    'event_id' => $event->id,
                    'path'     => 'events/' . $filename,
                ]);
            }
        }

        return response()->json([
            'message' => 'Event created successfully',
            'event'   => $event->load('images')
        ], 201);
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title'   => 'sometimes|required|string|max:255',
            'details' => 'nullable|string',
            'status'  => 'nullable|in:active,inactive',
            'images'  => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'exists:event_images,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $event->update($request->only(['title', 'details', 'status']));

        // Handle image removal
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $image = EventImage::where('event_id', $event->id)->find($imageId);
                if ($image) {
                    $path = public_path('storage/' . str_replace('\\', '/', $image->path));
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $image->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = now()->format("Y-m-d_H-i") . "-" . rand(10000, 99999) . "-" . $image->getClientOriginalName();
                $image->move(public_path('storage/events'), $filename);
                
                EventImage::create([
                    'event_id' => $event->id,
                    'path'     => 'events/' . $filename,
                ]);
            }
        }

        return response()->json([
            'message' => 'Event updated successfully',
            'event'   => $event->load('images')
        ]);
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Delete images from storage
        foreach ($event->images as $image) {
            $path = public_path('storage/' . str_replace('\\', '/', $image->path));
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }

    /**
     * Add a comment to an event.
     */
    public function addComment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'comment'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $comment = EventComment::create([
            'event_id'  => $id,
            'user_name' => $request->user_name,
            'comment'   => $request->comment,
            'is_approved' => true, // Auto-approve comments
        ]);

        return response()->json(['message' => 'Comment submitted for approval']);
    }

    /**
     * Like or unlike an event.
     */
    public function like(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        if ($request->input('action') === 'unlike') {
            if ($event->likes > 0) {
                $event->decrement('likes');
            }
        } else {
            $event->increment('likes');
        }
        
        return response()->json(['likes' => $event->likes]);
    }

    /**
     * Increment view count.
     */
    public function incrementViews($id)
    {
        if (is_numeric($id)) {
            $event = Event::findOrFail($id);
        } else {
            $title = str_replace('-', ' ', $id);
            $event = Event::where('title', 'LIKE', '%' . $title . '%')->firstOrFail();
        }
        $event->increment('views');
        return response()->json(['views' => $event->views]);
    }
    
    /**
     * Admin method to approve/disapprove comments.
     */
    public function updateCommentStatus(Request $request, $commentId)
    {
        $comment = EventComment::findOrFail($commentId);
        $comment->is_approved = $request->input('is_approved', true);
        $comment->save();
        
        return response()->json(['message' => 'Comment status updated']);
    }

    /**
     * List all comments for an event (admin view including unapproved).
     */
    public function getAdminComments($id)
    {
        $comments = EventComment::where('event_id', $id)->get();
        return response()->json($comments);
    }
}
