<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class searchController extends Controller
{
	protected $sort=null;
	protected $category=null;
	protected $query=null;

	protected $per_page=20;

	public function __construct(Request $request)
	{
		if ($request->has('sort')) { $this->sort = $request->sort; }
		if ($request->has('cat')) { $this->category = urldecode($request->cat); }
		if ($request->has('q')) { $this->query = $request->q; }
	}

	public function index(Request $request)
	{
		$relationships = ['category', 'images'];


		//Build relationship array based on account type
		$result = Product::with($relationships);

		//category
		if ($this->category){ $result->whereHas('category', function ($query){ $query->where('name', 'like',$this->category); }); }


		//search user attributes for records meeting search criteria.
		if ($this->query) {
			$result->where(function ($query) {
				$query->where('name', 'like', '%'.$this->query.'%')
					->orWhere('description', 'like', '%'.$this->query.'%')
					->orWhere('meta_title', 'like', '%'.$this->query.'%')
					->orWhere('meta_keywords', 'like', '%'.$this->query.'%')
					->orWhere('meta_desc', 'like', '%'.$this->query.'%');
			});
		}

		//price order
		if($this->sort == 'high-low') { $result->orderBy('price', 'desc'); }
		if($this->sort == 'low-high') { $result->orderBy('price', 'asc'); }

		//Sort
		if($this->sort == 'a-z') { $result->orderBy('name', 'asc'); }
		if($this->sort == 'z-a') { $result->orderBy('name', 'desc'); }
		if($this->sort == 'recent') { $result->orderBy('id', 'desc'); }
		if($this->sort == 'oldest') { $result->orderBy('id', 'asc'); }


		$result = $result->paginate($this->per_page);

		//dd($result->appends($request->input())->lastPage());
		return view('front.shop.index',
			[
				'results'=>$result->appends($request->input()),
			]);
	}
}
