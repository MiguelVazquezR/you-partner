<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'active' => $this->active,
            'users' =>  UserResource::collection($this->whenLoaded('users')),
            'homework' => HomeworkResource::make($this->whenLoaded('homework')),
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
        ];
    }
}
