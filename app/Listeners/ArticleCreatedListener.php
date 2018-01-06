<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Jobs\EmailForSubscribersJob;
use App\Models\User;

class ArticleCreatedListener
{

    public function onArticleCreated(ArticleCreated $event)
    {
        \Log::info('Article "' . $event->article->title . '" created');

        /**
         * @var User $subscriber
         */
        foreach ($event->user->subscribers as $subscriber) {
            EmailForSubscribersJob::dispatch($event->article->id, $subscriber->id)->onConnection('redis');
            \Log::info('Article "' . $event->article->title . '" added to queue for subscriber id: ' . $subscriber->id);
        }
    }

    /**
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(
            ArticleCreated::class,
            self::class . '@onArticleCreated'
        );
    }

}
