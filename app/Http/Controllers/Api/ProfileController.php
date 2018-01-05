<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 03.01.2018
 * Time: 16:13
 */

namespace App\Http\Controllers\Api;


use App\Http\{
    Controllers\Controller, Resources\ProfileResource
};


class ProfileController extends Controller
{

    public function show()
    {
        return new ProfileResource(auth()->user()); //optional
    }

}
