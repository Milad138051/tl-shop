<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use App\Models\Market\Guarantee;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;
	
    protected $table = 'cart_items';
    protected $fillable = ['user_id', 'product_id', 'color_id', 'guarantee_id','number'];

    public function product()
    {
      return $this->belongsTo(Product::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function color()
    {
      return $this->belongsTo(ProductColor::class);
    }

    public function guarantee()
    {
      return $this->belongsTo(Guarantee::class);
    }

    // productPrice + colorPrice + guaranteePrice
    public function cartItemProductPrice()
    {
      $productPrice=$this->product->price;
      $guaranteePriceIncrease=empty($this->guarantee_id) ? 0 : $this->guarantee->price_increase;
      $colorPriceIncrease=empty($this->color_id) ? 0 : $this->color->price_increase;
      return $productPrice + $colorPriceIncrease + $guaranteePriceIncrease;
    }


    // productPrice * (discountPercentage / 100)
    public function cartItemProductDiscount()
    {
      $cartItemProductPrice=$this->cartItemProductPrice();
      $productDiscount=empty($this->product->activeAmazingSale()) ? 0 : $cartItemProductPrice * ($this->product->activeAmazingSale()->percentage / 100 );
      return $productDiscount;
    }

    // number * (productPrice + colorPrice + guaranteePrice - discountPrice)
    public function cartItemFinalPrice()
    {
      $cartItemProductPrice=$this->cartItemProductPrice();
      $cartItemProductDiscount=$this->cartItemProductDiscount();
      return $this->number * ($cartItemProductPrice - $cartItemProductDiscount);
    }


    // number * productDiscount
    public function cartItemFinalDiscount()
    {
      $cartItemProductDiscount=$this->cartItemProductDiscount();
      return $this->number * $cartItemProductDiscount;
    }
	
	






  }

  