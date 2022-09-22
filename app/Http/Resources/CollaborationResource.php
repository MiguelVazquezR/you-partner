<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollaborationResource extends JsonResource
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
            'price' => $this->price,
            'tax' => $this->tax,
            'promise_date' => $this->promise_date?->isoFormat('DD MMMM, YYYY'),
            'completed_date' => $this->completed_date?->isoFormat('DD MMMM, YYYY'),
            'approved_at' => [
                'relative' => $this->approved_at?->diffForHumans(),
                'string' => $this->approved_at?->toDateTimeString(),
                'special' => $this->approved_at?->isoFormat('DD MMMM, YYYY'),
            ],
            'canceled_at' => [
                'relative' => $this->canceled_at?->diffForHumans(),
                'string' => $this->canceled_at?->toDateTimeString(),
                'special' => $this->canceled_at?->isoFormat('DD MMMM, YYYY'),
            ],
            'read_at' => [
                'relative' => $this->read_at?->diffForHumans(),
                'string' => $this->read_at?->toDateTimeString(),
                'special' => $this->read_at?->isoFormat('DD MMMM, YYYY'),
            ],
            'payed_at' => [
                'relative' => $this->payed_at?->diffForHumans(),
                'string' => $this->payed_at?->toDateTimeString(),
                'special' => $this->payed_at?->isoFormat('DD MMMM, YYYY'),
            ],
            'cancel_reason' => $this->cancel_reason,
            'completed_comments' => $this->completed_comments,
            'user' =>  $this->whenLoaded('user'),
            'claim' =>  $this->whenLoaded('claim'),
            'homework' => HomeworkResource::make($this->whenLoaded('homework')),
            'created_at' => [
                'relative' => $this->created_at?->diffForHumans(),
                'string' => $this->created_at?->toDateTimeString(),
                'special' => $this->created_at?->isoFormat('DD MMMM, YYYY'),
            ],
            'status' => $this->status()
        ];
    }
}