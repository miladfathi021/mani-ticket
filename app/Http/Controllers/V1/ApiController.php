<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiController extends Controller
{
    /**
     * @var int
     */
    private $status = 200;

    /**
     * @param $statusCode
     *
     * @return $this
     */
    public function setStatus($statusCode) : ApiController
    {
        $this->status = $statusCode;
        return $this;
    }

    /**
     * @param array  $data
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array|ResourceCollection|JsonResource $data = [], string $message = '') : \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $this->status);
    }
}