<?php

namespace Tests\Unit\Factories;

use App\Models\Article;
use Tests\TestDbAuthCase as Test;

/**
 * @property Article $article
 *
 * Class ArticleTest
 * @package Tests\Unit\Factories
 */
class ArticleTest extends Test
{

    public function testCreateArticle()
    {
        $this->article = factory(Article::class)->make();

        $this->user->articles()->save($this->article);

        $this->assertDatabaseHas('articles', $this->article->toArray());
    }

}
