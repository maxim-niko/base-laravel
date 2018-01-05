<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 03.01.2018
 * Time: 16:30
 */

namespace App\Models\Relations;


use App\Models\{
    Comment, Profile, User
};

trait ArticleRelation
{
    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id', 'user_id');
    }
}