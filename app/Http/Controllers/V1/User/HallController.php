<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\V1\ApiController;
use App\Http\Resources\HallResource;
use App\Models\EventHall;
use App\Services\HallService;

class HallController extends ApiController
{
    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $event_hall = EventHall::find($id);

        $hall = $event_hall->hall()->with('sections')->first();

        return $this->response(
            new HallResource($hall)
        );
    }
}
