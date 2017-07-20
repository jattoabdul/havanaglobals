<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    public static function deleteImage($id)
    {
        $image = ProductImage::find($id);
        $disk = Storage::disk(env('APP_DISK', 's3'));
        $exploded_img_link = explode('/', $image->img_link);
        $filename = end($exploded_img_link);
        $disk->delete($filename);
        $image->delete();
    }

    public function product() { return $this->belongsTo('App\Product'); }
}
