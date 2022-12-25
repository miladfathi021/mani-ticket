<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

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
     *
     * @param mixed  $data
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(mixed $data = [], string $message = '') : \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $this->status);
    }

    /**
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError(string $message =  'There is a problem!') : \Illuminate\Http\JsonResponse
    {
        return $this->setStatus(400)->response(message: $message);
    }
}
