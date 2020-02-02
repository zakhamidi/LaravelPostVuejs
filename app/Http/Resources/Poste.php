<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Poste extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => url('https://www.linkedin.com/in/zakaria-hamidi/')
        ];
    }
}
