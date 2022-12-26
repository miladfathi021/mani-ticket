<?php

namespace App\Filters;

class EventFilters extends Filters
{
    public function city($value)
    {
        return $this->builder->when($value, function ($query) use ($value) {
            return $query->whereHas('complex', function($innerQuery) use ($value) {
                return $innerQuery->where('city_id', $value);
            });
        });
    }

    public function artist($value)
    {
        return $this->builder->when($value, function ($query) use ($value) {
            return $query->whereHas('artist', function($innerQuery) use ($value) {
                return $innerQuery->where('id', $value);
            });
        });
    }
}
