<?php

namespace App\Models;

use App\Models\Attributes\ProfileAttributes;
use App\Models\Relations\ProfileRelation;
use Illuminate\Database\Eloquent\{
    Model, SoftDeletes
};


class Profile extends Model
{
    use SoftDeletes, ProfileRelation, ProfileAttributes;

    protected $fillable = [
        'first_name', 'last_name'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ];

}
