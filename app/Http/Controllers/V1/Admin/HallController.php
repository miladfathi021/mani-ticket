<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\HallRequest;
use App\Http\Resources\HallCollection;
use App\Http\Resources\HallResource;
use App\Models\Admin\Hall;
use App\Services\HallService;
use Illuminate\Http\Request;

class HallController extends ApiController
{
    protected HallService $hallService;

    /**
     * HallController constructor.
     *
     * @param \App\Services\HallService $hallService
     */
    public function __construct(HallService $hallService)
    {
        $this->hallService = $hallService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $halls = $this->hallService->getAll();

        return $this->response(
            new HallCollection($halls)
        );
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $halls = $this->hallService->getById($id);

        return $this->response(
            new HallResource($halls)
        );
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
