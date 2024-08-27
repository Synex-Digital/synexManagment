<?php

namespace App\Helpers;

use Intervention\Image\ImageManagerStatic as Image;

class Photo
{
    // Return Value
    public static $name;

    // Image Upload Methods
    public static function upload($file, $path, $prefix, $size = [])
    {
        if (file_exists(public_path($path))) {
            try {
                $extension = $file->getClientOriginalExtension();
                $name = $prefix . rand(1, 2000) . rand(1, 500) . '-' . date('dmy') . '.' . $extension;
                if (count($size) != 2) {
                    Image::make($file)->save(public_path($path . '/' . $name));
                } else {
                    Image::make($file)->resize($size[0], $size[1])->save(public_path($path . '/' . $name));
                }
                self::$name = $path . '/' . $name;
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        } else {
            return false;
        }
    }

    // Image Delete Methods
    public static function delete($path)
    {
        if (file_exists(public_path($path))) {
            try {
                $location = public_path($path);
                unlink($location);
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        } else {
            return false;
        }
    }
}
