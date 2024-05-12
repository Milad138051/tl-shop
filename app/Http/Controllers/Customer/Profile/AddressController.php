<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Address;


class AddressController extends Controller
{
    public function index()
	{
		$provinces=Province::all();
		return view('customer.profile.my-addresses',compact('provinces'));
	}
	
	
	public function destroy(Address $address)
	{
		$address->delete();
		return back()->with('success','آیتم با موفقیت حذف شد');
	}
}
