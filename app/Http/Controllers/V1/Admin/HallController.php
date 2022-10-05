<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\HallRequest;
use App\Http\Resources\HallResource;
use App\Models\Admin\Hall;
use App\Services\HallService;
use Illuminate\Http\Request;

class HallController extends ApiController
{
    protected $hallService;

    public function __construct(HallService $hallService)
    {
        $this->hallService = $hallService;
    }

    /**
     * @param \App\Http\Requests\Admin\HallRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HallRequest $request) : \Illuminate\Http\JsonResponse
    {
        $this->hallService->create($request->all());

        return $this->response(message: 'Hall created successfully!');
    }
}
