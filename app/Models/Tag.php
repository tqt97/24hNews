<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;


class Tag extends BaseModel
{
    use HasFactory,Sluggable;

    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_tag');
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
