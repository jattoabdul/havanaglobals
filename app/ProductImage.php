<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
	protected $table = 'product_images';
    public static function deleteImage($id)
    {
        $image = ProductImage::find($id);
        $disk = Storage::disk(env('APP_DISK', 's3'));
        $exploded_img_link = explode('/', $image->img_link);
        $filename = end($exploded_img_link);
        $disk->delete($filename);
        $image->delete();
    }

    public static function getSingleProductImage($pid) { return ProductImage::where('product_id',$pid)->first()->url; }

    public function product() { return $this->belongsTo('App\Product'); }
}
