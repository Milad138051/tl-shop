<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Market\Product;
use App\Models\Market\CartItem;

class CartController extends Controller
{
    public function cart()
    {
        if(Auth::check())
        {
            $cartItems=CartItem::where('user_id',Auth::user()->id)->get();
			if($cartItems->count() >0 )
			{
			
			//relatedCategories
			$relatedCategoriesIds=[];
			foreach($cartItems as $cartItem){
				$relatedCategoriesIdsDecoded=json_decode($cartItem->product->related_categories);
			};
			if($relatedCategoriesIdsDecoded!==null){
				$relatedProducts=Product::whereIn('category_id',$relatedCategoriesIdsDecoded)->get();
			}else{
				$relatedProducts=null;
			}
		    //
		
            return view('customer.sales-process.cart',compact('cartItems','relatedProducts'));				
			}else{
				return redirect()->back();
			}
        }
        else{
            return redirect()->route('auth.customer.login-register-form');
        }


    }

    public function updateCart(Request $request)
    {
		$inputs=$request->all();
		$cartItems=CartItem::where('user_id',Auth::user()->id)->get();
		
		foreach($cartItems as $cartItem)
		{
			if(isset($inputs['number'][$cartItem->id]))
			{
				$cartItem->update(['number'=>$inputs['number'][$cartItem->id]]);
			}
		}
		return redirect()->route('customer.sales-process.address-and-delivery');		

    }

    public function addToCart(Product $product,Request $request)
    {
      if(Auth::check())
      {
          $request->validate([
              'color' => 'nullable|exists:product_colors,id',
              'guarantee' => 'nullable|exists:guarantees,id',
              'number' => 'numeric|min:1|max:5'
          ]);

//چک میکنیم که این محصول رو قبلا کاربر تو سبدش داشته یا نه
          $cartItems = CartItem::where('product_id', $product->id)->where('user_id', auth()->user()->id)->get();

          if(!isset($request->color))
          {
              $request->color = null;
          }
          if(!isset($request->guarantee))
          {
              $request->guarantee = null;
          }



// چک میکنیم که محصولی که کاربر اضافه کرده به سبدش, رو قبلا هم با همین رنگ و گارانتی داشته یا نه
              foreach($cartItems as $cartItem)
              {
                  if($cartItem->color_id == $request->color && $cartItem->guarantee_id == $request->guarantee)
                  {
                    // اگه داشت
                          $cartItem->update(['number' => $request->number + $cartItem->number]);
                          return back()->with('alert-section-success', 'محصول مورد نظر با موفقیت به سبد خرید اضافه شد');;
                  }
              }

              $inputs = [];
              $inputs['color_id'] = $request->color;
              $inputs['guarantee_id'] = $request->guarantee;
              $inputs['user_id'] =  auth()->user()->id;
              $inputs['product_id'] =  $product->id;
              $inputs['number'] =  $request->number;

              CartItem::create($inputs);

              return back()->with('alert-section-success', 'محصول مورد نظر با موفقیت به سبد خرید اضافه شد');

      }
      else{
          return redirect()->route('auth.customer.login-register-form');
      }

    }

    public function removeFromCart(CartItem $cartItem)
    {
        if(Auth::user()->id=== $cartItem->user->id){
            $cartItem->delete();
            return back();
        }

    }
}
