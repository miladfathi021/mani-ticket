<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\V1\ApiController;
use App\Http\Requests\Admin\SectionRequest;
use App\Http\Requests\Admin\SectionUpdateRequest;
use App\Http\Resources\SectoionCollection;
use App\Http\Resources\SectoionResource;
use App\Models\Section;
use App\Services\SeatService;
use App\Services\SectionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SectionController extends ApiController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $sections = Section::query()->with(['hall', 'seats'])->latest()->get();

        return $this->response(
            new SectoionCollection($sections)
        );
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) : \Illuminate\Http\JsonResponse
    {
        $section = Section::query()->with(['hall', 'seats'])->findOrFail($id);

        return $this->response(
            new SectoionResource($section)
        );
    }

    /**
     * @param \App\Http\Requests\Admin\SectionRequest $request
     * @param \App\Services\SectionService            $sectionService
     * @param \App\Services\SeatService               $seatService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(
        SectionRequest $request,
        SectionService $sectionService,
        SeatService $seatService
    ) : \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();

            foreach ($request->get('sections') as $section) {

                $section = $sectionService->create($section);
                $seatService->create($section);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return $this->responseError();
        }

        DB::commit();

        return $this->response(message: 'Section created successfully!');
    }

    /**
     * @param \App\Http\Requests\Admin\SectionUpdateRequest $request
     * @param \App\Models\Section                           $section
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SectionUpdateRequest $request, Section $section) : \Illuminate\Http\JsonResponse
    {
        $section->update($request->only(['name', 'description']));

        return $this->response(message: 'Section updated successfully!');
    }

    /**
     * @param \App\Models\Section $section
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Section $section) : \Illuminate\Http\JsonResponse
    {
        $section->delete();

        return $this->response(message: 'Section deleted successfully!');
    }
}
