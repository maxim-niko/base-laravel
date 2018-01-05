<?php

namespace App\Jobs;

use App\Mail\NewArticleEmail;
use App\Models\{
    Article, User
};
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EmailForSubscribersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $article_id;
    private $subscriber_id;

    /**
     * EmailForSubscribersJob constructor.
     * @param int $article_id
     * @param int $subscriber_id
     */
    public function __construct(int $article_id, int $subscriber_id)
    {
        $this->article_id = $article_id;
        $this->subscriber_id = $subscriber_id;
    }

    /**
     * @return string
     */
    public function handle()
    {
        $article = Article::find($this->article_id);
        $subscriber = User::find($this->subscriber_id);
        $email = new NewArticleEmail($article, $subscriber);
        Mail::to($subscriber->email)->send($email);
    }
}
