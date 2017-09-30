<?php

namespace App\Transformers;


class CategoryTransformer extends Transformer
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