<?php

namespace App\Http\Controllers\Customer\Market;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Content\Comment;
use App\Models\Market\Compare;

class ProductController extends Controller
{
    public function product(Product $product)
	{
		$relatedProducts=Product::with('category')->whereHas('category',function($q) use ($product){
			$q->where('id',$product->category->id);
		})->get()->except($product->id);
		
		return view('customer.market.product.product',compact('product','relatedProducts'));
	}
	
	public function addComment(Product $product,Request $request)
	{
		$request->validate([
		'body'=>'required|max:2000',
		]);
		
        $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['commentable_id'] = $product->id;
        $inputs['commentable_type'] = Product::class;
        Comment::create($inputs);
		return redirect()->route('customer.market.product',$product->id)->with('swal-success',' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
	}
	
	public function addReplay(Product $product,Comment $comment,Request $request)
	{
		$request->validate([
		'body'=>'required|max:2000',
		]);
		
        $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->body);
        $inputs['author_id'] = Auth::user()->id;
        $inputs['parent_id'] = $comment->id;
        //$inputs['approved'] = 1;
        //$inputs['status'] = 1;
        $inputs['commentable_id'] = $product->id;
        $inputs['commentable_type'] = Product::class;
        Comment::create($inputs);
		return redirect()->route('customer.market.product',$product->id)->with('swal-success',' نظر شما با موفقیت ثبت شد و پس از تایید , نمایش داده خواهد شد');
	}
	
	public function addToFavorite(Product $product)
	{
	   if(Auth::check())
       {
        $product->user()->toggle([Auth::user()->id]);
        if($product->user->contains(Auth::user()->id)){
            return response()->json(['status' => 1]);
        }
        else{
            return response()->json(['status' => 2]);
        }
       }else{
        return response()->json(['status' => 3]);
	 }
	}
	
	public function addRate(Product $product,Request $request)
	{
		if(Auth::check())
		{
    		    $productIds=auth()->user()->isUserPurchedProduct($product->id);
			    $productIds=$productIds->unique();				
			}else{
				return back()->with('alert-section-error','خطا');
			}

		auth()->user()->rate($product,$request->rating);
		return back()->with('success','امتیاز شما با موفقیت ذخیره شد');
	}
	
	
	public function addToCompare(Product $product)
	{
	   if (Auth::check())
       {   $user=auth()->user();
		   if($user->compare()->count() > 0)
		   {
			   $userCompareList=$user->compare;
		   }else{
			   $userCompareList=Compare::create(['user_id'=>$user->id]);
		   }
           $product->compares()->toggle([$userCompareList->id]);
           if($product->compares->contains($userCompareList->id)){
            return response()->json(['status' => 1]);
           }
           else{
            return response()->json(['status' => 2]);
           }
       }else{
           return response()->json(['status' => 3]);
	        }
	}
	
	
}