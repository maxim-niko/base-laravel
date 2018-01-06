<?php

namespace App\Events;

use App\Models\{
    Article, User
};
use Illuminate\Queue\SerializesModels;

/**
 * @property Article $article
 * @property User $user
 *
 * Class ArticleCreated
 * @package App\Events
 */
class ArticleCreated
{
    use SerializesModels;

    public $article;
    public $user;

    public function __construct($user, $article)
    {
        $this->user = $user;
        $this->article = $article;
    }

}
