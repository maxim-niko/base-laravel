<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 04.01.2018
 * Time: 10:56
 */

namespace App\Repositories\Article;

use App\Models\Article;
use App\Repositories\BaseRepository;

class ArticleRepository extends BaseRepository
{

    public function model()
    {
        return Article::class;
    }


}