<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hall extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'complex_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complex() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Complex::class, 'complex_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Section::class, 'hall_id', 'id');
    }
}
