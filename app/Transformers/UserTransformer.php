<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * @param $user
     *
     * @return array
     */
    public function transform($user)
    {
        return [
            'id' => (int) $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'avatar' => $user['avatar'],
            'level' => $user['level'],
        ];
    }
}
