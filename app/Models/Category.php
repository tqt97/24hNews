<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['name', 'user_id', 'parent_id','image', 'is_highlight', 'status', 'slug'];

    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }
    public function post()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
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
