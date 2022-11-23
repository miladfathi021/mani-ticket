<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['row', 'column', 'seat_code', 'section_id'];

    static $STATUS = [
        'active' => 1,
        'pending' => 2,
        'reserved' => 3
    ];
}
