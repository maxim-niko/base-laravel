<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\{
    SubscribeRequest, UnsubscribeRequest, RegisterRequest
};
use App\Models\User;
use App\Services\Api\UserService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param RegisterRequest $request
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    public function registration(RegisterRequest $request)
    {
        try {
            $user = $this->service->registration($request);
            if ($user instanceof User) {
                return $this->success();
            }
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

    /**
     * @param SubscribeRequest $request
     * @return array
     */
    public function subscribe(SubscribeRequest $request)
    {
        try {
            if ($this->service->subscribe($request)) {
                return $this->success();
            }
            return $this->error();
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

    /**
     * @param UnsubscribeRequest $request
     * @return array
     */
    public function unsubscribe(UnsubscribeRequest $request)
    {
        try {
            if ($this->service->unsubscribe($request)) {
                return $this->success();
            }
            return $this->error();
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

}
