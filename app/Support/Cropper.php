<?php

namespace App\Support;

use CoffeeCode\Cropper\Cropper as C;

class Cropper
{
    const PATH_BACKEND = '../public/storage/cache';
    
    public static function thumb($path, $width, $height = null)
    {
        $path = config('filesystems.disks.public.root') . "/{$path}";
        $cropper = new C(storage_path(self::PATH_BACKEND));
        $pathThumb = $cropper->make($path, $width, $height);
        $file = collect(explode('/', $pathThumb))->last();
        return 'cache/' . $file;
    }

    public static function flush(?string $path)
    {
        $cropper = new C(storage_path(self::PATH_BACKEND));

        if(!empty($path)) {
            $cropper->flush($path);
        } else {
            $cropper->flush();
        }

    }
}
