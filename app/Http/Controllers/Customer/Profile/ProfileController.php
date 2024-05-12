<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
	{
		return view('customer.profile.profile');
	}
	
	
	public function update(UpdateProfileRequest $request)
	{
		$inputs=[
		'first_name'=>$request->first_name,
		'last_name'=>$request->last_name,
		'national_code'=>$request->national_code,
		];
		
		$user=auth()->user();
		$user->update($inputs);
		return redirect()->back()->with('success','اطلاعات حساب شما با موفقیت  ثبت شد');
	}
	
}
