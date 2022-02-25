<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;
use App\Traits\HandleTag;
use App\Traits\FilePondMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use App\Traits\TranslatableTrait;
// use Spatie\MediaLibrary\MediaCollections\File;


class Post extends BaseModel  implements HasMedia
{
    const LIMIT_TITLE = 50;
    const LIMIT_DESCRIPTION = 150;

    use HasFactory, Sluggable,  InteractsWithMedia, HandleTag, FilePondMedia, SoftDeletes, TranslatableTrait;

    protected $fillable = [
        'title', 'avatar', 'description', 'content', 'view_count', 'is_highlight', 'slug', 'author_id', 'category_id', 'status'
    ];

    public $translatable = ['title','description', 'content'];


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
        return $this->belongsToMany(Category::class, 'post_category');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(350)
            ->height(340);

        $this->addMediaConversion('main')
            ->width(730)
            ->height(708);
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

    public function scopeGetPost()
    {
        return $this->where('status', 1);
    }
    public function scopeHighlightPost()
    {
        return $this->with('media')->where('status', 1)->where('is_highlight', 1);
    }
    public function limitTitle()
    {
        return Str::limit($this->title,  self::LIMIT_TITLE);
    }
    public function limitDescription()
    {
        return Str::limit($this->description,  self::LIMIT_DESCRIPTION);
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
