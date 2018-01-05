<?php

namespace App\Models;

use App\Models\Relations\CommentRelation;
use Illuminate\Database\Eloquent\{
    Model, SoftDeletes
};

class Comment extends Model
{
    use SoftDeletes, CommentRelation;

    protected $fillable = [
        'article_id', 'desc', 'title'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'article_id', 'parent_id', 'user_id', 'updated_at', 'deleted_at'
    ];

}
