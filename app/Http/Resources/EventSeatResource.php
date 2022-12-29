<?php

namespace App\Http\Resources;

use App\Models\Seat;
use Illuminate\Http\Resources\Json\JsonResource;

class EventSeatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $status = collect(Seat::$STATUS)->flip();
        $seatStatus = $status->get($this['pivot']['seat_status']);

        return [
            "id" => $this['id'],
            "column" => $this['column'],
            "row" => $this['row'],
            "seat_code" => $this['seat_code'],
            "seat_status" => $seatStatus,
            "section_id" => $this['section_id'],
        ];
    }
}
