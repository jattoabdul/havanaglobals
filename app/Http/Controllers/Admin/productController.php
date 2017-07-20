<?php
/**
 * Created by PhpStorm.
 * User: jcobhams
 * Date: 7/12/17
 * Time: 12:54 AM
 */

namespace App\Http\Controllers\Admin;


use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    protected $per_page = 25;

    public function __construct(Request $request)
    {
        if ($request->per_page)
        {
            $this->per_page = $request->per_page;
        }
    }

    public function index(Request $request)
	{
	    $id=$request->id;
        $name=$request->name;
        $price_from= $request->price_from;
        $price_to=$request->price_to;
        $quantity_from= $request->quantity_from;
        $quantity_to=$request->quantity_to;
        $created_from=$request->created_from;
        $created_to=$request->created_to;
        $status=$request->status;

        $relationships = [];


        $products = Product::with($relationships);
        if ($id) { $products->where('id', $id); }
        if (!is_null($status)) { $products->where('status','=', $status); }
        if ($name) { $products->where('name', 'like', '%'.$name.'%'); }
        if ($price_from) { $products->where('price', '>=', $price_from); }
        if ($price_to) { $products->where('price', '<=', $price_to); }
        if ($quantity_from) { $products->where('qty', '>=', $quantity_from); }
        if ($quantity_to) { $products->where('qty', '<=', $quantity_to); }
        if ($created_from) { $products->where('created_at', '>=', Carbon::parse($created_from)->toDateTimeString()); }
        if ($created_to) { $products->where('created_at', '<=', Carbon::parse($created_to)->toDateTimeString()); }

		return view('admin.product.index', [
			'products' => $products->paginate($this->per_page)
		]);
	}

	public function create()
	{
		return view('admin.product.create', [
		    'categories' => Category::all()
        ]);
	}

	public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200|string',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'description' => 'nullable',
            'quantity' => 'integer|required',
            'status' => 'boolean|required',
            'meta_title' => 'string|nullable|max:200',
            'meta_description' => 'string|nullable|max:200',
            'meta_keywords' => 'string|nullable|max:1000',
            'stay' => 'boolean|required',
            'images.*.file' => 'nullable|image|max:1024',
            'images.*.label' => 'nullable|string|max:200',
            'images.*.sort_order' => 'nullable|integer',
            'categories.*' => 'nullable|integer'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->description = htmlspecialchars($request->description);
        $product->qty = $request->quantity;
        $product->status = $request->status;
        $product->meta_title = $request->meta_title;
        $product->meta_desc = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->save();

        //Sync Product and categories on pivot table
        if ($request->has('categories')) { $product->category()->sync($request->categories); }

        if ($request->hasFile('images.*.file'))
        {
            $disk = Storage::disk(env('APP_DISK', 's3'));
            foreach ($request->images as $image)
            {
                $file = $image['file'];
                $filename = sha1($file->getClientOriginalName().time()).'.'.strtolower($file->getClientOriginalExtension());
                $disk->put($filename, file_get_contents($file), ['visibility'=>'public', 'max-age' => '14515200']);

                $product_image = new ProductImage();
                $product_image->product_id = $product->id;
                $product_image->url = $disk->url($filename);

                if (array_key_exists('label', $image)) {
                    $product_image->label = $image['label'];
                }
                if (array_key_exists('sort_order', $image)) {
                    $product_image->order = $image['sort_order'];
                }
                $product_image->save();
            }
        }

        //If stay is 1, load "edit page" for the product
        if ($request->stay == 1) {
            return redirect()->route('edit_products', $product->id)->with('success', 'The product was added. You can continue editing.');
        } else {
            return redirect()->route('manage_products')->with('success', 'The product was added.');
        }
    }

	public function edit($id)
    {
        $product = Product::find($id);

        if ($product)
        {
            return view('admin.product.edit', [
                'categories' => Category::all(),
                'product' => $product,
                'category_ids' => Product::getProductCategoryIds($id)
            ]);
        } else { return redirect()->back()->with('error', 'The product does not exists.'); }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200|string',
            'id' => 'required|integer|exists:products,id',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'description' => 'nullable',
            'quantity' => 'integer|required',
            'status' => 'boolean|required',
            'meta_title' => 'string|nullable|max:200',
            'meta_description' => 'string|nullable|max:200',
            'meta_keywords' => 'string|nullable|max:1000',
            'stay' => 'boolean|required',
            'images.*.file' => 'nullable|image|max:1024',
            'images.*.label' => 'nullable|string|max:200',
            'images.*.sort_order' => 'nullable|integer',
            'categories.*' => 'nullable|integer'
        ]);

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->description = htmlspecialchars($request->description);
        $product->qty = $request->quantity;
        $product->status = $request->status;
        $product->meta_title = $request->meta_title;
        $product->meta_desc = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->save();

        //Sync Product and categories on pivot table
        if ($request->has('categories')) { $product->category()->sync($request->categories); }

        if ($request->has('images')){
            $disk = Storage::disk(env('APP_DISK', 's3'));

            foreach ($request->images as $image)
            {
                if (array_key_exists('file', $image))
                {
                    $file = $image['file'];
                    $filename = sha1($file->getClientOriginalName().time()).'.'.strtolower($file->getClientOriginalExtension());
                    $disk->put($filename, file_get_contents($file), ['visibility'=>'public', 'max-age' => '14515200']);

                    $product_image = new ProductImage();
                    $product_image->product_id = $product->id;
                    $product_image->url = $disk->url($filename);

                    if (array_key_exists('label', $image)) {
                        $product_image->label = $image['label'];
                    }
                    if (array_key_exists('sort_order', $image)) {
                        $product_image->order = $image['sort_order'];
                    }
                    $product_image->save();
                }
                else
                {
                    if (array_key_exists('id', $image)) {
                        $product_image = ProductImage::find($image['id']);

                        if (array_key_exists('label', $image)) {
                            $product_image->label = $image['label'];
                        }
                        if (array_key_exists('sort_order', $image)) {
                            $product_image->order = $image['sort_order'];
                        }
                        $product_image->save();
                    }

                }
            }
        }


        //If stay is 1, load "edit page" for the product
        if ($request->stay == 1) {
            return redirect()->route('edit_products', $product->id)->with('success', 'The product was updated. You can continue editing.');
        } else {
            return redirect()->route('manage_products')->with('success', 'The product was updated.');
        }
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:products,id'
        ]);

        Product::deleteProduct($request->id);

        return redirect()->route('manage_products')->with('success', 'The product was deleted.');
    }

    public function deleteMany(Request $request)
    {
        $this->validate($request, [
            'ids.*' => 'required|integer|exists:products,id'
        ]);

        foreach ($request->ids as $id)
        {
            Product::deleteProduct($id);
        }

        return redirect()->route('manage_products')->with('success', 'The products were deleted.');
    }

    public function deleteImage(Request $request)
    {
        $image = Product::find($request->id);
        if ($image)
        {
            ProductImage::deleteImage($image->id);
            $response = ['state'=>'success','msg'=>'The image was deleted.'];
        } else {
            $response = ['state'=>'error','msg'=>'The image does not exist.'];
        }

        return response()->json($response);
    }
}