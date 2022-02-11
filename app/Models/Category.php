<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['name', 'author_id', 'parent_id', 'is_highlight', 'status', 'slug'];

    public function author()
    {
        return $this->belongsTo(Admin::class,'author_id');
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_category');
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function childItems()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('categories');
    }
    public function imageUrl()
    {
        return "/upload/category/" . $this->image;
    }
    public function formatCreateAt()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
