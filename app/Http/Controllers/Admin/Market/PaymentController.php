<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments=Payment::all();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function offline()
    {
		$payments=Payment::where('paymentable_type','App\Models\Market\OfflinePayment')->get();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function online()
    {
        $payments=Payment::where('paymentable_type','App\Models\Market\OnlinePayment')->get();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function cash()
    {
        $payments=Payment::where('paymentable_type','App\Models\Market\CashPayment')->get();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function confirm()
    {
        return view('admin.market.payment.index');
    }
	public function canceled(Payment $payment)
	{
		$payment->status=2;
		$payment->save();
		return redirect()->back()->with('swal-success','تغییر با موفقیت اعمال شد');
	}
	public function returned(Payment $payment)
	{
		$payment->status=3;
		$payment->save();
		return redirect()->back()->with('swal-success','تغییر با موفقیت اعمال شد');
	}
	public function paid(Payment $payment)
	{
		$payment->status=1;
		$payment->save();
		return redirect()->back()->with('swal-success','تغییر با موفقیت اعمال شد');
	}
	public function notPaid(Payment $payment)
	{
		$payment->status=0;
		$payment->save();
		return redirect()->back()->with('swal-success','تغییر با موفقیت اعمال شد');
	}
	
	public function show(Payment $payment)
	{
	    return view('admin.market.payment.show',compact('payment'));
	}
}
