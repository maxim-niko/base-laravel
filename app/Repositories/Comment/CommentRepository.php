<?php
/**
 * Created by PhpStorm.
 * User: Maxim
 * Date: 04.01.2018
 * Time: 10:56
 */

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository
{

    public function model()
    {
        return Comment::class;
    }

    public function addParent(int $parent_id, Comment $comment): void
    {
        /**
         * @var Comment $parent
        */
        $parent = $this->getById($parent_id);

        $parent->child()->save($comment);
    }

}