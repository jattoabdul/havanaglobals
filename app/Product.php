<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $table = 'products';
    public static function getProductCategoryIds($product_id)
    {
        $product = Product::find($product_id);
        $ids=[];
        if ($product)
        {
            foreach ($product->category as $category)
            {
                $ids[] = $category->id;
            }
        }

        return $ids;
    }

    public static function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product)
        {
            $product->category()->detach();
            $disk=Storage::disk(env('APP_DISK', 's3'));
            foreach ($product->images as $image)
            {
                $exploded_img_link = explode('/', $image->img_link);
                $filename = end($exploded_img_link);
                $disk->delete($filename);
                $image->delete();
            }

            $product->delete();
        }
    }



	public function category(){ return $this->belongsToMany('App\Category','product_category','product_id','category_id'); }
	public function images() { return $this->hasMany('App\ProductImage'); }
}
