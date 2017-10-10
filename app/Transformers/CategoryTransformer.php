<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * @param $category
     * @return array
     */
    public function transform($category)
    {
        return [
            'id' => (int) $category['id'],
            'name' => $category['name'],
        ];
    }
}