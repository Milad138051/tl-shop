<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Market\Order;


class OrderController extends Controller
{
    public function index()
    {
		if(isset(request()->type))
		{
		    $orders=auth()->user()->orders()->where('order_status',request()->type)->orderBy('id','desc')->get();
		}
		else{
			$orders=auth()->user()->orders()->orderBy('id','desc')->get();		
			
		}
        return view('customer.profile.orders',compact('orders'));
    }
	
	public function showOrder(Order $order)
	{
		return view('customer.profile.show-orders',compact('order'));
	}
}









         