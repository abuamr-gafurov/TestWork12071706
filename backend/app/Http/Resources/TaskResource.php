<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => new UserResource($this->user),
            'title' => $this->title,
            'description' => $this->description,
            'completed_at' => date('d.m.Y H:i', strtotime($this->completed_at)),
            'created_at' => date('d.m.Y H:i', strtotime($this->created_at))
        ];
    }
}
