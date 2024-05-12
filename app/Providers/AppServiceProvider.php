<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Content\Comment;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\Market\CartItem;
use App\Models\User\Role;
use App\Models\User\Permission;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


        //admin user
        auth()->loginUsingId(1);
		
		//$user=auth()->user();
		//dd($user->roles);
		//dd($user->roles[0]->permissions);
		//dd($user->permissions);
		
		//$role=Role::find(1);
		//dd($role->permissions);
		//dd($role->users);
		
		//$permission=Permission::find(1);
		//dd($permission->users);
		//dd($permission->roles);

		view()->composer('admin.layouts.header',function($view){
			$view->with('unseenComments',Comment::where('seen',0)->get());
			$view->with('notifications',Notification::where('read_at',null)->get());
		});

        view()->composer('customer.layouts.header',function($view){
            if(Auth::check()){
                $cartItems=CartItem::where('user_id',Auth::user()->id)->get();
                $view->with('cartItems',$cartItems);
            }
		});
    }
}
