<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function formatCreateAt()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y');
    }
    // public function posts()
    // {
    //     return $this
    //         ->belongsToMany(Post::class, 'post_tags', 'tag_id', 'post_id')
    //         ->withTimestamps();
    // }
}
