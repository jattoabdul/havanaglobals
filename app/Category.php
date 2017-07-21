<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $table = 'category';

    public static function addCategory($name, $img=null)
	{
		$category = new Category();
		$category->name = $name;
		$category->img = $img;
		$category->save();
	}

    public static function updateCategory($id, $name, $img=null)
	{
		$category = Category::find($id);
		$category->name = $name;
		if(!is_null($img) && $category->img)
		{
			$disk = Storage::disk(env('APP_DISK', 's3'));
			$exploded_img_link = explode('/', $category->img);
			$filename = end($exploded_img_link);
			$disk->delete($filename);
		}
		if($img) { $category->img = $img; }
		$category->save();
	}

	public static function deleteCategory($id)
	{
		$category = Category::find($id);
		if($category->img)
		{
			$disk = Storage::disk(env('APP_DISK', 's3'));
			$exploded_img_link = explode('/', $category->img);
			$filename = end($exploded_img_link);
			$disk->delete($filename);
		}
		$category->delete();
	}

	public function products(){ return $this->belongsToMany('App\Product','product_category','category_id','product_id'); }
}
