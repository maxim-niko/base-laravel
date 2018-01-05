<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProfileResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'full_name' => optional($this->profile)->full_name,
            'count' => [
                'articles' => $this->articles()->count(),
                'subscribers' => $this->subscribers()->count(),
            ]
        ];
    }
}
