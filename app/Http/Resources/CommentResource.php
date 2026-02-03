<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'content'=>$this->content,
            'upVotes'=>$this->upVotes,
            'downVotes'=>$this->downVotes,
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'firstName' => $this->user->firstName,
                    'lastName' => $this->user->lastName,
                ];
            }),
            'post' => $this->whenLoaded('post', function () {
                return [
                    'id' => $this->post->id,
                    'postContent' => substr($this->post->postContent,15)
                ];
            }),
            'createdAt'=>$this->createdAt,
            'updatedAt'=>$this->updatedAt,
        ];
    }
}
