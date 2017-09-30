<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/30
 * Time: 11:20
 */

namespace App\Repositories;


use App\Category;
use App\Repositories\Eloquent\Repository;

class CategoryRepository extends Repository
{
    public function model()
    {
        return Category::class;
    }
}