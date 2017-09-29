<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Video.
 *
 * @property $name
 * @property $category_id
 * @property $path
 * @property $likes
 * @property $dislikes
 */
class Video extends Model
{
    protected $table = 'videos';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'category_id', 'path', 'user_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUser()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get likes/Dislikes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getLikesDislikes()
    {
        return $this->hasMany(LikeDislike::class);
    }

    /**
     * Call scope likes.
     *
     * @return mixed
     */
    public function likes()
    {
        return $this->hasMany(LikeDislike::class)->likes();
    }

    /**
     * Call scope dislikes.
     *
     * @return mixed
     */
    public function dislikes()
    {
        return $this->hasMany(LikeDislike::class)->dislikes();
    }

    /**
     * Get comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
