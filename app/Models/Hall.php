<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hall extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'parent_id', 'name', 'address', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Section::class, 'hall_id', 'id');
    }
}
