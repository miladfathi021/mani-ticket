<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\ApiController;
use App\Http\Resources\CityCollection;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends ApiController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : \Illuminate\Http\JsonResponse
    {
        $cities = City::all();
        return $this->response(
            new CityCollection($cities)
        );
    }
}
