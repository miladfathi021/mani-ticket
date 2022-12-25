<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\ComplexRequest;
use App\Http\Requests\Admin\ComplexUpdateRequest;
use App\Http\Resources\ComplexCollection;
use App\Http\Resources\ComplexResource;
use App\Models\Complex;

class ComplexController extends ApiController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $complexes = Complex::query()->latest()->get();

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
        $complex = Complex::query()->findOrFail($id);

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
        auth()->user()->complexes()->create($request->all());

        return $this->response(message: 'Complex created successfully!');
    }

    /**
     * @param \App\Http\Requests\Admin\ComplexUpdateRequest $request
     * @param \App\Models\Complex                           $complex
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ComplexUpdateRequest $request, Complex $complex) : \Illuminate\Http\JsonResponse
    {
        $complex->update($request->all());

        return $this->response(message: 'Complex updated successfully!');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Complex $complex) : \Illuminate\Http\JsonResponse
    {
        $complex->delete();

        return $this->response(message: 'Complex deleted successfully!');
    }
}
