<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filters
{
    protected Request $request;
    protected Builder $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function filters() : \Illuminate\Support\Collection
    {
        return collect($this->request->all());
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder) : Builder
    {
        $this->builder = $builder;
        $this->filters()->each(function ($value, $key) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        });

        return $this->builder;
    }
}
