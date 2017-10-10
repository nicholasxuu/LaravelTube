<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class LikeDislikeTransformer.
 */
class LikeDislikeTransformer extends TransformerAbstract
{
    /**
     * @param $likeDislike
     *
     * @return array
     */
    public function transform($likeDislike)
    {
        return [
            'user_id'    => (int) $likeDislike['user_id'],
            'video_id'   => (int) $likeDislike['video_id'],
            'type'       => $likeDislike['type'],
        ];
    }
}
