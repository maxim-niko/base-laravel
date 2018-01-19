<?php

namespace Tests\Unit\Article\Routes\Frontend;

use App\Models\Article;
use Tests\TestDbAuthCase as Test;

/**
 * @property Article $article
 *
 * Class ArticleViewTest
 * @package Tests\Unit\Article\Frontend
 */
class ArticleTest extends Test
{
    public function testIndexArticle()
    {
        $this->article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $this->get(route('article.index'))
            ->assertSee($this->article->title);
    }

    public function testShowArticle()
    {
        $this->article = factory(Article::class)->create(['user_id' => $this->user->id]);
        $this->get(route('article.show', ['id' => $this->article->id]))
            ->assertSee($this->article->title);
    }


}
