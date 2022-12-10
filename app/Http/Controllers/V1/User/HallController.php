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

    public function show($id)
    {
        $sections = $this->hallService->get_a_hall_with_sections($id);

        return $this->response(
            new HallResource($sections)
        );
    }
}
