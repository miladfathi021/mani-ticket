<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventHall extends Model
{
    use HasFactory;

    protected $table = 'event_hall';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hall() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }
}
