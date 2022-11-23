<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\SectionRequest;
use App\Http\Resources\SectoionCollection;
use App\Services\SectionService;

class SectionController extends ApiController
{
    protected SectionService $sectionService;

    /**
     * SectionController constructor.
     *
     * @param \App\Services\SectionService $sectionService
     */
    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    /**
     * @param \App\Http\Requests\Admin\SectionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SectionRequest $request) : \Illuminate\Http\JsonResponse
    {
        $this->sectionService->create($request->all());

        return $this->response(message: 'Section created successfully!');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $sections = $this->sectionService->getAll();

        return $this->response(
            new SectoionCollection($sections)
        );
    }
}