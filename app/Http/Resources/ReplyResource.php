<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ReplyResource extends JsonResource
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
            'id' => $this->id,
            'reply' => $this->body,
            'question_id' => $this->question_id,
            'user' => $this->user->name,
            'user_id' => $this->user->user_id,
            'question_slung' => $this->question->slung,
            'like_count' => $this->like->count(),
            'liked' => !!$this->like->where('user_id', Auth::id())->count(),
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
