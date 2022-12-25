<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\HallRequest;
use App\Http\Requests\Admin\HallUpdateRequest;
use App\Http\Resources\HallCollection;
use App\Http\Resources\HallResource;
use App\Models\Hall;

class HallController extends ApiController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $halls = Hall::query()->with('complex')->latest()->get();

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
        $halls = Hall::query()->with('complex')->findOrFail($id);

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
        Hall::create($request->all());

        return $this->response(message: 'Hall created successfully!');
    }

    /**
     * @param \App\Http\Requests\Admin\HallUpdateRequest $request
     * @param \App\Models\Hall                           $hall
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(HallUpdateRequest $request, Hall $hall) : \Illuminate\Http\JsonResponse
    {
        $hall->update($request->all());

        return $this->response(message: 'Hall updated successfully!');
    }

    /**
     * @param \App\Models\Hall $hall
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Hall $hall) : \Illuminate\Http\JsonResponse
    {
        $hall->delete();

        return $this->response(message: 'Hall deleted successfully!');
    }
}
