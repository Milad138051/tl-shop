<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class loginRegisterController extends Controller
{
    public function loginRegisterForm()
	{
	  return view('customer.auth.login-register');	
	} 

    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();

        //check id is email or not
        if(filter_var($inputs['id'], FILTER_VALIDATE_EMAIL))
        {
            $type = 1; // 1 => email
            $user = User::where('email', $inputs['id'])->first();
            if(empty($user)){
                $newUser['email'] = $inputs['id'];
            }
        }

        //check id is mobile or not
        elseif(preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['id'])){
            $type = 0; // 0 => mobile;


            // all mobile numbers are in on format 9** *** ***
            $inputs['id'] = ltrim($inputs['id'], '0');
            $inputs['id'] = substr($inputs['id'], 0, 2) === '98' ? substr($inputs['id'], 2) : $inputs['id'];
            $inputs['id'] = str_replace('+98', '', $inputs['id']);

            $user = User::where('mobile', $inputs['id'])->first();
            if(empty($user)){
                $newUser['mobile'] = $inputs['id'];
            }
        }

        else{
            $errorText = 'شناسه ورودی شما نه شماره موبایل است نه ایمیل';
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id' => $errorText]);
        }

        if(empty($user)){
            $newUser['password']='98355154';
            $newUser['activation']=1;
            $user=User::create($newUser);
        }

        //create otp code

        $otpCode=rand(111111,999999);
        $token=Str::random(60);
        $otpInputs=[
            'token'=>$token,
            'user_id'=>$user->id,
            'otp_code'=>$otpCode,
            'login_id'=>$inputs['id'],
			'type'=>$type,
        ];

        Otp::create($otpInputs);


        //send sms or email

        if($type == 0){
            //send sms

            // az inja jadide va khodam ba log minevisam chon service sms nadaram

            //Log::info('کد تایید:'.' '.$otpCode .' '.'برای کاربر:'.' '.$user->id);
            Log::info("your code is : $otpCode and is sent to your mobile");
        }
		
	    elseif($type == 1){
			//send email
           
  		   Log::info("your code is : $otpCode and is sent to your email");

        }
		
		return redirect()->route('auth.customer.login-register-confirm-form',$token);
    }
	
	
	
	public function loginRegisterConfirmForm($token)
	{
		$otp=Otp::where('token',$token)->first();
		if(empty($otp)){
			return redirect()->route('auth.customer.login-register-form')->withErrors(['id'=>'آدرس وارد شده معتبر نمیباشد']);
		}
		return view('customer.auth.login-register-confirm',compact('token','otp'));
	
	}	
	
	public function loginRegisterConfirm($token,LoginRegisterRequest $request)
	{
		$inputs=$request->all();
		
		$otp=Otp::where('token',$token)->where('used',0)->where('created_at','>=', Carbon::now()->subMinute(1)->toDateTimeString())->first();
		
		
		if(empty($otp)){
		   return redirect()->route('auth.customer.login-register-form',$token)->withErrors(['id'=>'کد وارد شده معتبر نمیباشد']);
		}
		
		if($otp->otp_code !== $inputs['otp']){
		   return redirect()->route('auth.customer.login-register-confirm-form',$token)->withErrors(['otp'=>'کد وارد شده صحیح نمیباشد']);
		}
		
		$otp->update(['used'=>1]);
		$user=$otp->user()->first();
		
		if($otp->type == 0 && empty($user->mobile_verified_at)){
			$user->update(['mobile_verified_at'=>Carbon::now()]);
		}
		elseif($otp->type == 1 && empty($user->email_verified_at)){
			$user->update(['email_verified_at'=>Carbon::now()]);

		}
		
		Auth::login($user);
	    return redirect()->route('customer.home');
	}
	
	
	public function loginRegisterResendOtp($token)
	{
		$otp=Otp::where('token',$token)->where('created_at','<=',Carbon::now()->subMinute(1)->toDateTimeString())->first();
		
		if(empty($otp)){
		  return redirect()->route('auth.customer.login-register-form',$token)->withErrors(['id'=>'لطفا کد ارسال شده را بصورت صحیح وارد نمایید']);
		}
		
		
		
		$user=$otp->user()->first();
		 //create otp code

        $otpCode=rand(111111,999999);
        $token=Str::random(60);
        $otpInputs=[
            'token'=>$token,
            'user_id'=>$user->id,
            'otp_code'=>$otpCode,
            'login_id'=>$otp->login_id,
			'type'=>$otp->type,
        ];

        Otp::create($otpInputs);


        //send sms or email

        if($otp->type == 0){
            //send sms

            // az inja jadide va khodam ba log minevisam chon service sms nadaram

            //Log::info('کد تایید:'.' '.$otpCode .' '.'برای کاربر:'.' '.$user->id);
            Log::info("your code is : $otpCode and is sent to your mobile");
        }
		
	    elseif($otp->type == 1){
           
  		   Log::info("your code is : $otpCode and is sent to your email");

        }
		
		return redirect()->route('auth.customer.login-register-confirm-form',$token);
    
	}
	
	public function logout()
	{
		Auth::logout();
		return redirect()->route('customer.home');
	}
	
	
	
	
	
}
