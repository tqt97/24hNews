<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, SoftDeletes,Sluggable;

    protected $fillable = ['name', 'user_id', 'image', 'is_new', 'status', 'slug'];

    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }

    public function imageUrl()
    {
        return "/upload/category/" . $this->image;
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($category) {
    //         $category->slug = $category->createSlug($category->name);
    //         $category->save();
    //     });
    // }
    // private function createSlug($name)
    // {
    //     if (static::whereSlug($slug = Str::slug($name))->exists()) {

    //         $max = static::whereName($name)->latest('id')->skip(1)->value('slug');

    //         if (is_numeric($max[1])) {
    //             return preg_replace_callback('/(\d+)$/', function ($mathces) {
    //                 return $mathces[1] + 1;
    //             }, $max);
    //         }
    //         return "{$slug}-2";
    //     }
    //     return $slug;
    // }
}
