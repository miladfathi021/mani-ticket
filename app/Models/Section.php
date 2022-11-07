<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'hall_id', 'row_count', 'column_count', 'row_number_from', 'column_number_from'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seats() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Seat::class, 'section_id', 'id');
    }
}
