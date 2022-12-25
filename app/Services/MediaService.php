<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    /**
     * @param $name
     * @param $path
     * @param $file
     * @param $type
     * @param $model
     *
     * @return void
     */
    private static function upload($name, $path, $file, $type, $model)
    {
        $media = new Media();
        $media->path = $path . '/' . $name;
        $media->type = $type;

        Storage::disk('public')->putFileAs($path, $file, $name);
        self::addMedia($media, $model);
    }

    /**
     * @param $model
     * @param $request
     *
     * @return void
     */
    public static function store($model, $request)
    {
        $file = $request->file('media');
        $name = $file->hashName();

        $path = strtolower(class_basename($model)) . '/' . $request->media_type;

        self::upload($name, $path, $file, $request->media_type, $model);
    }

    /**
     * @param \App\Models\Media $media
     * @param                   $model
     *
     * @return void
     */
    private static function addMedia(Media $media, $model): void
    {
        $media->mediable_type = $model::class;
        $media->mediable_id = $model->id;
        $media->save();
    }
}
