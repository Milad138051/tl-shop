<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Market\Product;

class Compare extends Model
{
    use HasFactory,SoftDeletes;
	
	 protected $guarded = ['id'];
	 
	 
	 public function user()
	 {
		 return $this->belongsTo(User::class);
	 }

	 public function products()
	 {
		 return $this->belongsToMany(Product::class);
	 }
	 
	 
	
	
	
}
