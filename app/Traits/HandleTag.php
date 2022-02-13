<?php

namespace App\Traits;

use App\Models\Tag;

trait HandleTag
{
    public function storeTag($request)
    {
        $tagIds = [];
        if (!empty($request->tags)) {
            $tags = $request->tags;
            foreach ($tags as $item) {
                $tag = Tag::firstOrCreate(['name' => $item]);
                $tagIds[] = $tag->id;
            }
        }
        return $tagIds;
    }
}
