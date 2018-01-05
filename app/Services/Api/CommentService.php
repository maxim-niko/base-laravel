<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 04.01.2018
 * Time: 11:15
 */

namespace App\Services\Api;

use App\Http\Requests\Api\Comment\CommentCreate;
use App\Models\{
    Article, Comment
};
use App\Repositories\{
    Article\ArticleRepository,
    Comment\CommentRepository
};
use Illuminate\Support\Facades\DB;

class CommentService
{
    private $comments;
    private $articles;

    public function __construct(ArticleRepository $articleRepository, CommentRepository $commentRepository)
    {
        $this->articles = $articleRepository;
        $this->comments = $commentRepository;
    }

    /**
     * @param CommentCreate $request
     * @return Comment
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(CommentCreate $request): Comment
    {
        /**
         * @var Article $article
         * @var Comment $child
         */
        $article = $this->articles->getById($request->article_id);

        return DB::transaction(function () use ($article, $request) {

            $user = \Auth::user();
            $comment = $this->comments->new([
                'article_id' => $request->article_id,
                'title' => $request->title,
                'desc' => $request->desc,
            ]);

            $user->comments()->save($comment);

            if ($request->parent_id) {
                $this->comments->addParent($request->parent_id, $comment);
            }

            return $comment;
        });
    }

}