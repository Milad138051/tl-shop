<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function readAll()
	{
		$notifications=Notification::where('read_at',null)->get();
		foreach($notifications as $item){
			$item->update(['read_at'=>now()]);
		}
	}
}
