<?php

namespace App\Mail;

use App\Models\{
    Article, User
};
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewArticleEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $article;
    private $subscriber;


    public function __construct(Article $article, User $subscriber)
    {
        $this->article = $article;
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.subscribe')->with(['name' => $this->subscriber->profile->first_name, 'article_id' => $this->article->id]);
    }
}
