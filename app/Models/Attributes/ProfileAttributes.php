<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 03.01.2018
 * Time: 17:00
 */

namespace App\Models\Attributes;


trait ProfileAttributes
{
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}