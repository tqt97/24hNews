<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

class Post extends Model  implements HasMedia
{
    const LIMIT_TITLE = 50;
    const LIMIT_DESCRIPTION = 150;

    use HasFactory, Sluggable,  InteractsWithMedia;

    protected $fillable = [
        'title', 'description', 'content', 'view_count', 'is_highlight', 'slug', 'author_id', 'category_id', 'status'
    ];

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }
    public function author()
    {
        return $this->belongsTo(Admin::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category')->withTimestamps();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tag')->withTimestamps();
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('small')
            ->width(80)
            ->height(80)
            ->withResponsiveImages();
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300)
            ->withResponsiveImages();
        $this->addMediaConversion('main')
            ->width(800)
            ->height(600)
            ->withResponsiveImages();
    }
    public function limitTitle()
    {
        return Str::limit($this->title,  self::LIMIT_TITLE);
    }
    public function limitDescription()
    {
        return Str::limit($this->description,  self::LIMIT_DESCRIPTION);
    }


    // public function getCategoriesLinksAttribute()
    // {
    //     $categories = $this->categories()->get()->map(function ($category) {
    //         return '<a href="' . route('articles.index') . '?category_id=' . $category->id . '">' . $category->name . '</a>';
    //     })->implode(' | ');

    //     if ($categories == '') return 'none';

    //     return $categories;
    // }

    // public function getTagsLinksAttribute()
    // {
    //     $tags = $this->tags()->get()->map(function ($tag) {
    //         return '<a href="' . route('articles.index') . '?tag_id=' . $tag->id . '">' . $tag->name . '</a>';
    //     })->implode(' | ');

    //     if ($tags == '') return 'none';

    //     return $tags;
    // }

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
