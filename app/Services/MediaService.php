<?php

namespace App\Services;

class MediaService
{
    public function upload($file)
    {
        return $file->store('images', 'public');
    }
}
