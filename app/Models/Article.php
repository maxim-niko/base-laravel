<?php

namespace App\Models;

use App\Models\Relations\ArticleRelation;
use Illuminate\Database\Eloquent\{
    Model, SoftDeletes
};

class Article extends Model
{
    use SoftDeletes, ArticleRelation;

    protected $fillable = [
        'title', 'desc', 'user_id'
    ];

    protected $hidden = [
        'updated_at', 'deleted_at'
    ];

}
