<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Director extends Model
{
    use HasFactory;

    protected $table = 'directors';

    protected $fillable = [
        'name',
        'position',
        'parent_id',
        'image',
    ];

    /**
     * Get the parent director
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Director::class, 'parent_id');
    }

    /**
     * Get all children directors
     */
    public function children(): HasMany
    {
        return $this->hasMany(Director::class, 'parent_id');
    }

    /**
     * Get all descendants (children, grandchildren, etc.)
     */
    public function descendants(): HasMany
    {
        return $this->children()->with('descendants');
    }

    /**
     * Get all ancestors (parent, grandparent, etc.)
     */
    public function ancestors()
    {
        $ancestors = collect();
        $parent = $this->parent;

        while ($parent) {
            $ancestors->push($parent);
            $parent = $parent->parent;
        }

        return $ancestors;
    }

    /**
     * Check if this director is a root (has no parent)
     */
    public function isRoot(): bool
    {
        return is_null($this->parent_id);
    }

    /**
     * Check if this director is a leaf (has no children)
     */
    public function isLeaf(): bool
    {
        return $this->children()->count() === 0;
    }

    /**
     * Get the depth level of this director in the tree
     */
    public function getDepth(): int
    {
        return $this->ancestors()->count();
    }

    /**
     * Scope to get only root directors
     */
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Get tree structure starting from this director
     */
    public function getTreeAttribute()
    {
        return $this->load('descendants');
    }
}