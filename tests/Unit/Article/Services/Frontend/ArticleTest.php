<?php

namespace Tests\Unit\Article\Services\Frontend;

use App\Http\Requests\Frontend\Article\ArticleCreate;
use App\Models\Article;
use App\Repositories\Article\ArticleRepository;
use App\Services\Frontend\ArticleService;
use Tests\TestDbAuthCase as Test;

/**
 * @property Article $article
 *
 * Class ArticleViewTest
 * @package Tests\Unit\Article\Frontend
 */
class ArticleTest extends Test
{
    /**
     * @var ArticleService $service
    */
    private $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = new ArticleService(new ArticleRepository());
    }

    public function testCreate()
    {
        $article = factory(Article::class)->make();
        $request = $this->createMock(ArticleCreate::class);
        $request->title = $article->title;
        $request->desc = $article->desc;
        $article = $this->service->create($request);
        $this->assertInstanceOf(Article::class, $article);
        $this->assertDatabaseHas('articles', $article->toArray());
    }

}
