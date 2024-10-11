<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUpload
{
    public static function upload($key, $path): null|string
    {
        $request = request();
        if ($request->hasFile($key)) {
            $file = $request->file($key);
            $file_name = time() . Str::random(16) . '.' . Str::replace(' ', '-', $file->getClientOriginalExtension());
            Storage::disk('public')->putFileAs($path, $file, $file_name);

            return $file_name;
        }

        return null;
    }

    public static function update($key, $model, $attribute, $path): null|string
    {
        $request = request();
        if ($request->hasFile($key)) {

            if ($model->$attribute && Storage::disk('public')->exists( $path.'/' . $model->$attribute)) {
                Storage::disk('public')->delete( $path.'/' . $model->$attribute);
            }

            $file = $request->file($key);
            $file_name = time() . Str::random(16) . '.' . Str::replace(' ', '-', $file->getClientOriginalExtension());
            Storage::disk('public')->putFileAs($path, $file, $file_name);

            return $file_name;
        }

        return $model->$attribute;
    }

    public static function delete($model, $attribute, $path): null|true
    {
        if ($model->$attribute && Storage::disk('public')->exists( $path.'/' . $model->$attribute)) {
            Storage::disk('public')->delete( $path.'/' . $model->$attribute);

            return true;
        }

        return null;
    }
}