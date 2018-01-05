<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 03.01.2018
 * Time: 16:30
 */

namespace App\Models\Relations;


use App\Models\{
    Article,
    Comment,
    Profile
};

trait UserRelation
{

    public function subscribers()
    {
        return $this->belongsToMany(self::class, 'subscribers', 'user_id', 'subscriber_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}