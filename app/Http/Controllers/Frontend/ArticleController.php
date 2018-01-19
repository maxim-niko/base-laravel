<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Http\Requests\Frontend\Article\{
    ArticleIndex,
    ArticleCreate
};

use App\Http\Resources\{
    ArticleResource,
    ArticleResourceCollection
};

use App\Models\Article;
use App\Services\Frontend\ArticleService;
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
        return view('frontend.articles.index', [
            'articles' => $this->service->getListAll($request)->paginate()
        ]);
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
        try {
            return view('frontend.articles.show', ['article' => Article::findOrFail($id)]);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage(), null, $e);
        }
    }

}
