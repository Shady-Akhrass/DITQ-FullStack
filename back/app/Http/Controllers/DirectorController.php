<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class DirectorController extends Controller
{
    public function index(): JsonResponse
    {
        $directors = Director::with(['parent', 'children'])->get();

        return response()->json([
            'success' => true,
            'data' => $directors->map(function ($director) {
                return $this->formatDirectorData($director);
            }),
            'total' => $directors->count()
        ]);
    }

    public function show($id): JsonResponse
    {
        $director = Director::with(['parent', 'children'])->find($id);

        if (!$director) {
            return response()->json([
                'success' => false,
                'message' => 'Director not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatDirectorData($director)
        ]);
    }

    public function getTree(): JsonResponse
    {
        $roots = Director::with(['descendants'])->roots()->get();

        return response()->json([
            'success' => true,
            'data' => $this->formatTreeData($roots),
            'total_roots' => $roots->count()
        ]);
    }

    public function getSubTree($id): JsonResponse
    {
        $director = Director::with(['descendants'])->find($id);

        if (!$director) {
            return response()->json([
                'success' => false,
                'message' => 'Director not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatNodeData($director)
        ]);
    }

    public function getChildren($id): JsonResponse
    {
        $director = Director::with('children')->find($id);

        if (!$director) {
            return response()->json([
                'success' => false,
                'message' => 'Director not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $director->children->map(function ($child) {
                return $this->formatDirectorData($child);
            }),
            'total' => $director->children->count()
        ]);
    }

    public function getAncestors($id): JsonResponse
    {
        $director = Director::find($id);

        if (!$director) {
            return response()->json([
                'success' => false,
                'message' => 'Director not found'
            ], 404);
        }

        $ancestors = $director->ancestors();

        return response()->json([
            'success' => true,
            'data' => $ancestors->map(function ($ancestor) {
                return $this->formatDirectorData($ancestor);
            }),
            'total' => $ancestors->count()
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'parent_id' => 'nullable|exists:directors,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'director\\' . date("Y-M-dH:i") . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
                $image->move(public_path('storage/director'), $filename);
                $validated['image'] = str_replace('\\', '/', $filename);
            }

            $director = Director::create($validated);

            return response()->json([
                'success' => true,
                'data' => $this->formatDirectorData($director->load(['parent', 'children'])),
                'message' => 'Director created successfully'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log the detailed error for debugging
            \Log::error('Failed to create director: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create director',
                'error' => 'هناك خطأ في البيانات الخاصة في ال api key'
            ], 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $director = Director::find($id);

            if (!$director) {
                return response()->json([
                    'success' => false,
                    'message' => 'Director not found'
                ], 404);
            }

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'position' => 'sometimes|required|string|max:255',
                'parent_id' => 'nullable|exists:directors,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if (isset($validated['parent_id']) && $this->wouldCreateCircularReference($director->id, $validated['parent_id'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot set parent: would create circular reference'
                ], 400);
            }

            if ($request->hasFile('image')) {
                if ($director->image && file_exists(public_path('storage/' . $director->image))) {
                    unlink(public_path('storage/' . $director->image));
                }
                $image = $request->file('image');
                $filename = 'director\\' . date("Y-M-dH:i") . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
                $image->move(public_path('storage/director'), $filename);
                $validated['image'] = str_replace('\\', '/', $filename);
            }

            $director->update($validated);

            return response()->json([
                'success' => true,
                'data' => $this->formatDirectorData($director->load(['parent', 'children'])),
                'message' => 'Director updated successfully'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log the detailed error for debugging
            \Log::error('Failed to update director: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update director',
                'error' => 'هناك خطأ في البيانات الخاصة في ال api key'
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $director = Director::find($id);

            if (!$director) {
                return response()->json([
                    'success' => false,
                    'message' => 'Director not found'
                ], 404);
            }

            $childrenCount = $director->children()->count();
            if ($childrenCount > 0) {
                $director->children()->update(['parent_id' => $director->parent_id]);
            }

            if ($director->image && file_exists(public_path('storage/' . $director->image))) {
                unlink(public_path('storage/' . $director->image));
            }

            $director->delete();

            return response()->json([
                'success' => true,
                'message' => "Director deleted successfully. {$childrenCount} children were moved to parent level.",
                'children_affected' => $childrenCount
            ]);
        } catch (\Exception $e) {
            // Log the detailed error for debugging
            \Log::error('Failed to delete director: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete director',
                'error' => 'هناك خطأ في البيانات الخاصة في ال api key'
            ], 500);
        }
    }

    private function formatTreeData($directors)
    {
        return $directors->map(function ($director) {
            return $this->formatNodeData($director);
        });
    }

    private function formatNodeData($director)
    {
        return [
            'id' => $director->id,
            'name' => $director->name,
            'position' => $director->position,
            'image' => $director->image ? url('storage/' . str_replace('\\', '/', $director->image)) : null,
            'parent_id' => $director->parent_id,
            'children' => $director->children->map(function ($child) {
                return $this->formatNodeData($child);
            }),
            'is_root' => $director->isRoot(),
            'is_leaf' => $director->isLeaf(),
            'depth' => $director->getDepth(),
            'children_count' => $director->children->count(),
            'created_at' => $director->created_at,
            'updated_at' => $director->updated_at
        ];
    }

    private function formatDirectorData($director)
    {
        return [
            'id' => $director->id,
            'name' => $director->name,
            'position' => $director->position,
            'image' => $director->image ? url('storage/' . str_replace('\\', '/', $director->image)) : null,
            'parent_id' => $director->parent_id,
            'parent' => $director->parent ? [
                'id' => $director->parent->id,
                'name' => $director->parent->name,
                'position' => $director->parent->position
            ] : null,
            'children_count' => $director->children ? $director->children->count() : 0,
            'is_root' => $director->isRoot(),
            'is_leaf' => $director->isLeaf(),
            'depth' => $director->getDepth(),
            'created_at' => $director->created_at,
            'updated_at' => $director->updated_at
        ];
    }

    private function wouldCreateCircularReference($directorId, $parentId)
    {
        if ($directorId == $parentId) {
            return true;
        }

        $parent = Director::find($parentId);
        while ($parent) {
            if ($parent->id == $directorId) {
                return true;
            }
            $parent = $parent->parent;
        }

        return false;
    }
}
