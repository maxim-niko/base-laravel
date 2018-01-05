<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 04.01.2018
 * Time: 11:15
 */

namespace App\Services\Api;

use App\Exceptions\BaseException;
use App\Http\Requests\Api\User\{
    RegisterRequest, SubscribeRequest, UnsubscribeRequest
};
use App\Models\User;
use App\Notifications\Auth\UserNeedsConfirmation;
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;

class UserService
{
    private $users;
    private $profiles;

    public function __construct(UserRepository $userRepository, ProfileRepository $profileRepository)
    {
        $this->users = $userRepository;
        $this->profiles = $profileRepository;
    }

    /**
     * @param RegisterRequest $request
     * @return User
     * @throws \Exception
     * @throws \Throwable
     */
    public function registration(RegisterRequest $request): User
    {
        return DB::transaction(function () use ($request) {

            $user = $this->users->create([
                'name' => $request->first_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => User::STATUS_UNCONFIRMED,
            ]);

            if ($user) {

                $profile = $this->profiles->new([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                ]);

                $user->profile()->save($profile);

            }

            $user->notify(new UserNeedsConfirmation($user->confirmation_code));

            return $user;

        });

    }

    /**
     * @param SubscribeRequest $request
     * @return bool
     */
    public function subscribe(SubscribeRequest $request): bool
    {
        /**
         * @var User $user
         */
        $user = $this->users->getById($request->id);

        $user->subscribers()->attach(\Auth::user());

        return $user->hasSubscriber(\Auth::user());
    }

    /**
     * @param UnsubscribeRequest $request
     * @return bool
     */
    public function unsubscribe(UnsubscribeRequest $request): bool
    {
        /**
         * @var User $user
         */
        $user = $this->users->getById($request->id);

        $user->subscribers()->detach(\Auth::user());

        return !$user->hasSubscriber(\Auth::user());

    }


    /**
     * @param $code
     * @return mixed
     * @throws BaseException
     */
    public function confirm($code)
    {
        $user = $this->users->findByConfirmationCode($code);

        if ($user->confirmed == User::STATUS_CONFIRMED) {
            throw new BaseException('User already confirmed!');
        }

        if ($user->confirmation_code == $code) {
            $user->confirmed = User::STATUS_CONFIRMED;

            return $user->save();
        }

        throw new BaseException('Invalid confirmation code.');
    }


}