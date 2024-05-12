<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Market\Product;

class ProductColor extends Model
{  
    use HasFactory, SoftDeletes;
	 
	 
    protected $fillable = ['product_id','color','color_name','price_increase'];
	
	
	public function product()
	{
		return $this->belongsTo(Product::class);
	}

  

}
