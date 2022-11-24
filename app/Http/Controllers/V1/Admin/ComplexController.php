<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\ComplexRequest;
use App\Http\Requests\Admin\ComplexUpdateRequest;
use App\Http\Resources\ComplexCollection;
use App\Http\Resources\ComplexResource;
use App\Services\ComplexService;

class ComplexController extends ApiController
{
    protected ComplexService $complexService;

    /**
     * ComplexController constructor.
     *
     * @param \App\Services\ComplexService $complexService
     */
    public function __construct(ComplexService $complexService)
    {
        $this->complexService = $complexService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $complexes = $this->complexService->getAll();

        return $this->response(
            new ComplexCollection($complexes)
        );
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $complex = $this->complexService->getById($id);

        return $this->response(
            new ComplexResource($complex)
        );
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
     * @param \App\Http\Requests\Admin\ComplexUpdateRequest $request
     * @param                                               $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ComplexUpdateRequest $request, $id) : \Illuminate\Http\JsonResponse
    {
        $this->complexService->update($request->all(), $id);

        return $this->response(message: 'Complex updated successfully!');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) : \Illuminate\Http\JsonResponse
    {
        $this->complexService->delete($id);

        return $this->response(message: 'Complex deleted successfully!');
    }
}
