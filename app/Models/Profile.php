<?php

namespace App\Models;

use App\Models\Attributes\ProfileAttributes;
use App\Models\Relations\ProfileRelation;
use Illuminate\Database\Eloquent\{
    Model, SoftDeletes
};


/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 *
 * @property string $full_name
 *
 * Class Profile
 * @package App\Models
 */
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
