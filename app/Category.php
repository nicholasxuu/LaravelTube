<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    protected $hidden = [];

    public function getVideos()
    {
        return $this->hasMany(Video::class, 'category_id', 'id');
    }


}