<?php

namespace App\Http\Controllers\Api;

use App\Http\{
    Controllers\Controller, Requests\Api\Article\ArticleCreate, Requests\Api\Article\ArticleIndex, Resources\ArticleResource, Resources\ArticleResourceCollection
};

use App\Models\Article;
use App\Services\Api\ArticleService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ArticleController extends Controller
{
    private $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ArticleIndex $request
     * @return ArticleResourceCollection
     */
    public function index(ArticleIndex $request)
    {
        $articles = $this->service->getListAll($request);
        return new ArticleResourceCollection($articles->paginate());
    }

    /**
     * @param ArticleCreate $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(ArticleCreate $request)
    {
        try {
            $article = $this->service->create($request);
            return redirect()->route('api.article.show', ['id' => $article->id]);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

    /**
     * @param $id
     * @return ArticleResource
     */
    public function show($id)
    {
        if ($article = Article::find($id)) {
            try {
                return new ArticleResource($article);
            } catch (\DomainException $e) {
                throw new BadRequestHttpException($e->getMessage(), null, $e);
            }
        }

        throw new BadRequestHttpException();

    }

}
