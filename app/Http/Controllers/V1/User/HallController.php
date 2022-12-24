<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\V1\ApiController;
use App\Http\Resources\HallResource;
use App\Services\HallService;

class HallController extends ApiController
{
    protected HallService $hallService;

    public function __construct(HallService $hallService)
    {
        $this->hallService = $hallService;
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $hall = $this->hallService->get_a_hall_with_sections($id);

        if($hall->count()) {
            $hall->event_hall_id = $id;
        }

        return $this->response(
            (new HallResource($hall))
        );
    }
}
