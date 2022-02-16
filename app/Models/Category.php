<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\FilePondMedia;
use Illuminate\Support\Facades\Cache;

class Category extends BaseModel implements HasMedia
{
    use HasFactory, Sluggable, InteractsWithMedia, FilePondMedia;

    protected $fillable = ['name', 'author_id', 'parent_id', 'is_highlight', 'status', 'slug'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category');
    }
    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function allChildrens()
    {
        return $this->childs()->with('childrens');
    }
    public function scopeGetCategory()
    {
        return $this->with('media')->where('status', 1);
    }
    public function getCateImageAttribute()
    {
        // return Cache::remember('cate_post', 15, function () {
            return $this->getFirstMediaUrl('categories', 'main');
        // });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(540)
            ->height(524);

        $this->addMediaConversion('main')
            ->width(1580)
            ->height(300);
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
