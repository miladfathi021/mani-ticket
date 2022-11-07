<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\ComplexRequest;
use App\Http\Resources\ComplexCollection;
use App\Http\Resources\ComplexResource;
use App\Services\ComplexService;

class ComplexController extends ApiController
{
    protected ComplexService $complexService;

    /**
     * HallController constructor.
     *
     * @param \App\Services\ComplexService $complexService
     */
    public function __construct(ComplexService $complexService)
    {
        $this->complexService = $complexService;
    }

    /**
     * @param \App\Http\Requests\Admin\ComplexRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ComplexRequest $request) : \Illuminate\Http\JsonResponse
    {
        $this->complexService->create($request->all());

        return $this->response(message: 'Complex created successfully!');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $halls = $this->complexService->getAll();

        return $this->response(
            new ComplexCollection($halls)
        );
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $halls = $this->complexService->getById($id);

        return $this->response(
            new ComplexResource($halls)
        );
    }
}
