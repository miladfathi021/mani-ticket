<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'date_start' => $this->date_start,
            'time_start' => $this->time_start,
            'date_end' => $this->date_end,
            'time_end' => $this->time_end,
            'artist' => new ArtistResource($this->whenLoaded('artist')),
            'complex' => new ComplexResource($this->whenLoaded('complex')),
            'halls' => new HallCollection($this->whenLoaded('halls')),
        ];
    }
}
