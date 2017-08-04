<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class contentController extends Controller
{
    public function index()
	{
		return view('admin.content.index', [
			'contents' => Content::all()
		]);
	}

    public function edit($id)
	{
		return view('admin.content.edit', [
			'content' => Content::find($id),
			'parents' => Content::where('top', 1)->get()
		]);
	}

	public function update(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|string|max:255',
			'body' => 'nullable|string',
			'status' => 'required|boolean',
			'parent' => 'string|exists:contents,slug',
			'id' => 'required|integer|exists:contents,id'
		]);

		$content = Content::find($request->id);
		$content->title = $request->title;
		$content->body = htmlspecialchars($request->title);
		$content->status = $request->status;
		$content->parent = $request->parent;
		$content->save();

		return redirect()->route('manage_content')->with('success', 'Content updated');
	}
}
