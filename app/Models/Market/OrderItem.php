<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Market\Product;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderItem extends Model
{
	
	protected $guarded=['id'];
	
    use HasFactory,SoftDeletes;
	
	public function order()
	{
	    return $this->belongsTo(Order::class);
	}
	
	public function singleProduct()
	{
	    return $this->belongsTo(Product::class,'product_id');
	}
	
	public function amzaingSale()
	{
	    return $this->belongsTo(AmazingSale::class);
	}
	
	public function color()
	{
	    return $this->belongsTo(ProductColor::class);
	}	
	
	public function guarantee()
	{
	    return $this->belongsTo(Guarantee::class);
	}
	
	public function orderItemAttributes()
	{
		return $this->hasMany(OrderItemSelectedAttribute::class);
	}
	
}
