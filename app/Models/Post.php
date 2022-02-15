<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;
use App\Traits\HandleTag;
use App\Traits\UploadMedia;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\MediaCollections\File;

class Post extends BaseModel  implements HasMedia
{
    const LIMIT_TITLE = 50;
    const LIMIT_DESCRIPTION = 150;

    use HasFactory, Sluggable,  InteractsWithMedia, HandleTag, UploadMedia;

    protected $fillable = [
        'title','avatar', 'description', 'content', 'view_count', 'is_highlight', 'slug', 'author_id', 'category_id', 'status'
    ];

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }
    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category')->withTimestamps();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    //     ->useFallbackUrl('/images/anonymous-user.jpg')
    // ->useFallbackPath(public_path('/images/anonymous-user.jpg'));
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb-50')
            ->width(50)
            ->height(50);

        $this->addMediaConversion('thumb-100')
            ->width(100)
            ->height(100);
    }

    public function getAuthorNameAttribute()
    {
        return Cache::remember('author_name', 15, function () {
            return $this->author->name;
        });
    }
    public function getPostImageAttribute()
    {
        return Cache::remember('image_post', 15, function () {
            return $this->getFirstMediaUrl('image_post', 'thumb-100');
        });
    }
    public function getPostCategoryAttribute()
    {
        return Cache::remember('post_categories', 15, function () {
            return $this->categories;
        });
    }
    public function getPostTagAttribute()
    {
        return Cache::remember('post_tags', 15, function () {
            return $this->tags;
        });
    }
    public function getCommentCountAttribute()
    {
        return Cache::remember('comment_count', 15, function () {
            return $this->comments->count();
        });
    }
    // public function scopeSearchCategory()
    // {
    //     return $this->when(request('category_id'), function ($query) {
    //         return $query->whereHas('categories', function ($q) {
    //             return $q->where('id', request('category_id'));
    //         });
    //     });
    // }
    public function scopeGetPost()
    {
        return $this->where('status', 1);
    }
    public function scopeHighlightPost()
    {
        return $this->where('status', 1)->where('is_highlight', 1);
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
