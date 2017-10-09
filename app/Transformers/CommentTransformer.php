<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class CommentTransformer.
 */
class CommentTransformer extends TransformerAbstract
{
    /**
     * @param $comment
     *
     * @return array
     */
    public function transform($comment)
    {
        return [
            'id'          => (int) $comment['id'],
            'user_id'     => (int) $comment['user_id'],
            'video_id'    => (int) $comment['video_id'],
            'comment'     => $comment['comment'],
        ];
    }
}
