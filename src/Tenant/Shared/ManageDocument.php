<?php

namespace Src\Tenant\Shared;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Response;

class ManageDocument
{
    static function encodeImage($image)
    {
        try {
            $encodedImage = [];
            $encodedImage['image'] = Image::make($image);
            $encodedImage['extension'] = $image->getClientOriginalExtension();
            Response::make($encodedImage['image']->encode($encodedImage['extension']));

            return $encodedImage;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    static function getImage($image, $imageExt, $width = 0, $height = 0)
    {
        try {
            $image_file = ($width != 0 && $height != 0) ? Image::make($image)->resize($width, $height) : Image::make($image);
            $response = Response::make($image_file->encode($imageExt));
            $response->header('Content-Type', 'image/' . $imageExt);
            return $response;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return $e->getMessage();
        }
    }
}