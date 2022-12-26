<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complex extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'parent_id', 'name', 'address', 'description', 'city_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function halls() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Hall::class, 'complex_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Event::class, 'complex_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
