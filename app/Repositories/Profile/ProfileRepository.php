<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 04.01.2018
 * Time: 10:56
 */

namespace App\Repositories\Profile;


use App\Models\Profile;
use App\Repositories\BaseRepository;

class ProfileRepository extends BaseRepository
{

    public function model()
    {
        return Profile::class;
    }

}