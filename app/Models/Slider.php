<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\FilePondMedia;
use Illuminate\Support\Facades\Cache;

class Slider extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, FilePondMedia;
    protected $fillable = ['title', 'description', 'url', 'order', 'status'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
        $this->addMediaConversion('main')
            ->width(494)
            ->height(428);
    }
    public function scopeGetSlider()
    {
        return $this->with('media')->where('status', 1);
    }
    public function getSliderImageAttribute()
    {
        return Cache::remember('image_slider', 15, function () {

            return $this->getFirstMediaUrl('sliders', 'main');
        });
    }
    public function getSliderImageThumbAttribute()
    {

        return $this->getFirstMediaUrl('sliders', 'thumb');
    }

}