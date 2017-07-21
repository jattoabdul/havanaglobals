<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class categoryController extends Controller
{
    public function index()
	{
		return view('admin.category.index', [
			'categories' => Category::all()
		]);
	}

	public function save(Request $request)
	{
		$this->validate($request, [
			'name' => 'string|required|max:250|unique:category,name',
			'img' => 'image|max:1024'
		]);

		$img = null;
		$disk = Storage::disk(env('APP_DISK', 's3'));
		if($request->hasFile('img'))
		{
			$file = $request->file('img');
			$filename = sha1($file->getClientOriginalName().time()).'.'.strtolower($file->getClientOriginalExtension());
			$disk->put($filename, file_get_contents($file), ['visibility'=>'public', 'max-age' => '14515200']);

			$img = $disk->url($filename);
		}

		Category::addCategory($request->name, $img);

		return redirect()->back()->with('success', 'The category was created successfully.');
	}

	public function edit($id)
	{
		return view('admin.category.edit', [
			'category' => Category::find($id)
		]);
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'img' => 'nullable|image|max:1024',
			'name' => 'required|string|max:250|unique:category,name,'.$id
		]);

		$img = null;
		$disk = Storage::disk(env('APP_DISK', 's3'));
		if($request->hasFile('img'))
		{
			$file = $request->file('img');
			$filename = sha1($file->getClientOriginalName().time()).'.'.strtolower($file->getClientOriginalExtension());
			$disk->put($filename, file_get_contents($file), ['visibility'=>'public', 'max-age' => '14515200']);

			$img = $disk->url($filename);
		}
		Category::updateCategory($id, $request->name, $img);

		return redirect()->route('manage_categories')->with('success', 'The category was deleted successfully.');
	}

	public function delete(Request $request)
	{
		$this->validate($request, [
			'id' => 'required|integer|exists:category,id'
		]);
		Category::deleteCategory($request->id);

		return redirect()->back()->with('success', 'The category was deleted successfully.');
	}
}
