<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Market\Product;

class CompareController extends Controller
{
    public function index()
	{
		return view('customer.profile.my-compares');
	}
	
    public function delete(Product $product)
	{
		//$user=auth()->user();
		//$user->compare->products->remove($product->id);
		//return redirect()->back()->with('success','محصول با موفقیت از لیست حذف شد');
	}
	
	
}
