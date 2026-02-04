<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'postContent' => $this->postContent,
            'title' => $this->title,
            'upVotes' => $this->upVotes,
            'downVotes' => $this->downVotes,
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category->id,
                    'title' => $this->category->title,
                ];
            }),
            'comments' => $this->whenLoaded('comment', function () {
                return $this->comment->map(fn($comment) => [
                    'id' => $comment->id,
                    'content' => substr($comment->content, 15),
                    'userId' => $comment->userId,
                    'createdAt' => $comment->createdAt,
                ]);
            }),
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'firstName' => $this->user->firstName,
                    'lastName' => $this->user->lastName,
                    'reputation' => $this->user->reputation,
                    'email' => $this->user->email
                ];
            }),
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
