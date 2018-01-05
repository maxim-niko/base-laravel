<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 04.01.2018
 * Time: 10:56
 */

namespace App\Repositories\User;


use App\Models\User;
use App\Exceptions\BaseException;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{

    public function model()
    {
        return User::class;
    }

    /**
     * @param $code
     *
     * @return mixed
     * @throws BaseException
     */
    public function findByConfirmationCode($code)
    {
        $user = $this->model
            ->where('confirmation_code', $code)
            ->first();

        if ($user instanceof $this->model) {
            return $user;
        }

        throw new BaseException('User not found!');
    }


}