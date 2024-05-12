<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Market\Product;

class Gallery extends Model
{
      use HasFactory, SoftDeletes;
	 
	 protected $table='product_images';
	 
    protected $fillable = ['image','product_id'];
  
     protected $casts = ['image' => 'array'];
	 
	 public function product()
	 {
		 return $this->belongsTo(Product::class);
	 }

}
