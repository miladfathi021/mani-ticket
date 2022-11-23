<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HallResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'complex' => new ComplexResource($this->whenLoaded('complex')),
            'hall_event_id' => $this->whenPivotLoaded('event_hall', function() {
                return $this->pivot->id;
            }),
            'date_start' => $this->whenPivotLoaded('event_hall', function() {
                return $this->pivot->date_start;
            }),
            'time_start' => $this->whenPivotLoaded('event_hall', function() {
                return $this->pivot->time_start;
            }),
            'date_end' => $this->whenPivotLoaded('event_hall', function() {
                return $this->pivot->date_end;
            }),
            'time_end' => $this->whenPivotLoaded('event_hall', function() {
                return $this->pivot->time_end;
            }),
        ];
    }
}
