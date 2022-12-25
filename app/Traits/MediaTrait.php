<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait MediaTrait
{
    /**
     * @return string
     */
    public function getImagePathAttribute() : string
    {
        return $this->image ? asset(Storage::disk('local')->url($this->image->path)) : '';
    }
}
