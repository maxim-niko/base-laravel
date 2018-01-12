<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 04.01.2018
 * Time: 11:15
 */

namespace App\Services\Api;


use App\Events\ArticleCreated;
use App\Http\Requests\Api\Article\{
    ArticleCreate, ArticleIndex
};
use App\Models\Article;
use App\Repositories\Article\ArticleRepository;

class ArticleService
{
    private $articles;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articles = $articleRepository;
    }

    /**
     * @param ArticleCreate $request
     * @return mixed
     */
    public function create(ArticleCreate $request)
    {
        $user = \Auth::user();

        $article = $this->articles->new([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);

        $user->articles()->save($article);

        if (!empty($user->subscribers)) {
            event(new ArticleCreated($user, $article));
        }

        return $article;

    }

    /**
     * @param ArticleIndex $request
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function getListAll(ArticleIndex $request)
    {
        $articles = Article::with('comments', 'profile');
        if (!empty($request->input('sort'))) {
            $articles->withCount('comments');
            $articles->orderBy($request->input('sort'), 'desc');
        }

        return $articles;
    }


}