<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->desc,
            'comments' =>
                $this->comments()
                ->with(['child' => function ($q) {
                    $q->with('profile');
                }])
                ->where(function ($q) {
                    $q->whereNull("parent_id");
                })
                ->get(),
            'writer' => $this->profile,
        ];
    }

}
