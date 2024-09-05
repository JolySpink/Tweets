<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'Username' => $this->Username,
            'CategoryId' => $this->CategoryId,
            'Content' => $this->Content,
            'created_at' => date('d.m.Y H:i', strtotime($this->created_at)),
        ];
    }
}
