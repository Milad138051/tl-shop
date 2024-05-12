<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Market\Product;

class FavoriteController extends Controller
{
    public function index()
	{
		return view('customer.profile.my-favorite');
	}
	
	
	public function delete(Product $product)
	{
		$user=auth()->user();
		$user->products()->detach($product->id);
		return redirect()->back()->with('success','محصول با موفقیت از لیست علاقه مندیهای شما حذف شد');
	}
}
