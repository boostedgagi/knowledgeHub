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
            'id'=>$this->id,
            'postContent'=>$this->postContent,
            'upVotes'=>$this->upVotes,
            'downVotes'=>$this->downVotes,
            'category' => $this->whenLoaded('category', function () {
                return [
                    'id' => $this->category->id,
                    'title' => $this->category->title,
                ];
            }),
            'comment'=>$this->whenLoaded('comment',function (){
                return $this->comment->map(fn($comment)=>[
                    'id'=>$comment->id,
                    'content'=>substr($comment->content,15),
                    'userId'=>$comment->userId,
                    'createdAt'=>$comment->createdAt,
                ]);
            }),
            'createdAt'=>$this->createdAt,
            'updatedAt'=>$this->updatedAt,
        ];
    }
}
