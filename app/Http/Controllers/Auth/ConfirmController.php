<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Api\UserService;

class ConfirmController extends Controller
{

    private $service;

    /**
     * ConfirmController constructor.
     *
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->middleware('guest');
        $this->service = $service;
    }

    /**
     * @param $code
     *
     * @return mixed
     * @throws \App\Exceptions\BaseException
     */
    public function confirm($code)
    {
        $this->service->confirm($code);

        return redirect('/')->withFlashSuccess('Your account has been successfully confirmed!');
    }


}
