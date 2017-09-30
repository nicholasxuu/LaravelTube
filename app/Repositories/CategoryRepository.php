<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/30
 * Time: 11:20
 */

namespace App\Repositories;


class CategoryRepository extends Repository
{
    protected function model()
    {
        return Category::class;
    }
}