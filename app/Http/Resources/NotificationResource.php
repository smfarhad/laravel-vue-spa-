<?php

namespace App\Http\Resources;

use App\Model\Reply;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'read_at' => $this->read_at,
            'replyBy' => $this->data['replyBy'],
            'question' => $this->data['question'],
            'path' => $this->data['path'],
        ];
    }
}
