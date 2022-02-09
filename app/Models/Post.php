<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title', 'description', 'content', 'image', 'view_count', 'is_highlight', 'slug', 'user_id', 'category_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(Admin::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function tags()
    {
        return $this
            ->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id')
            ->withTimestamps();
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'comment_id', 'id');
    }

    public function imageUrl()
    {
        return "/upload/post/" . $this->image;
    }
    public function formatCreateAt()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
