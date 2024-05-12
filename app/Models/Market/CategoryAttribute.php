<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Market\ProductCategory;
use App\Models\Market\CategoryValue;




class CategoryAttribute extends Model
{
    use HasFactory, SoftDeletes;


  protected $fillable = ['name', 'type', 'unit', 'category_id'];

	public function category()
	{
		return $this->belongsTo(ProductCategory::class);
	}

	public function values()
	 {
		 return $this->hasMany(CategoryValue::class);
	 }
}
