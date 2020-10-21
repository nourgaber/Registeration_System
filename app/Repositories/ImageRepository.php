<?php
namespace App\Repositories;

use App\Models\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ImageRepository
{
    /**
     * @param $path
     * @param $imageableId
     * @param $imageableIdType
     *
     * @return \App\Models\Image
     */
    public function createImage($path, $imageableId, $imageableIdType)
    {
        $image = new Image;
        $image->nampathe = $path;
        $image->imageable_id = $imageableId;
        $image->imageable_id_type = $imageableIdType;
        $image->save();
        return $image;
    }

}
