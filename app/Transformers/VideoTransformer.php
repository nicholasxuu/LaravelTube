<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class VideoTransformer.
 */
class VideoTransformer extends TransformerAbstract
{
    /**
     * @param $video
     *
     * @return array
     */
    public function transform($video)
    {
        return [
            'id'        => $video['id'],
            'name'      => $video['name'],
            'category'  => $video->getCategory,
            'path'      => $video['path'],
            'likes'     => $video->likes()->count(),
            'dislikes'  => $video->dislikes()->count(),
            'comments'  => $video->getComments,
        ];
    }
}
