<?php

namespace App\Traits;

use Storage;

trait HandleTag
{
    public function storeTag($request)
    {
        $tagIds = [];
        if (!empty($request->tags)) {
            $tags = $request->tags;
            foreach ($tags as $item) {
                $tag = $this->tag->firstOrCreate(['name' => $item]);
                $tagIds[] = $tag->id;
            }
        }
        return $tagIds;
    }
}
