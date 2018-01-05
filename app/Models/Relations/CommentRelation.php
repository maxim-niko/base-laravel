<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 03.01.2018
 * Time: 16:30
 */

namespace App\Models\Relations;


use App\Models\{
    Article, Comment, Profile, User
};

trait CommentRelation
{
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function child()
    {
        return $this->hasOne(Comment::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }
}