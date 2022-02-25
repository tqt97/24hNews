<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;


class Comment extends BaseModel
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'post_id', 'status'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    public function getAuthorNameAttribute()
    {
        return Cache::remember('author_comment', 15, function () {
            return $this->author->name;
        });
    }
    public function formatCreateAt()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
