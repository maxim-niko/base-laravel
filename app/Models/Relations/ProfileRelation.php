<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 03.01.2018
 * Time: 16:30
 */

namespace App\Models\Relations;

use App\Models\User;


trait ProfileRelation
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
