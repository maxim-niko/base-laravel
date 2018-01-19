<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\CommentCreate;
use App\Services\Api\CommentService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CommentController extends Controller
{
    private $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CommentCreate $request
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(CommentCreate $request)
    {
        try {
            $comment = $this->service->create($request);
            return $this->success('Success!', $comment->toArray());
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

}
