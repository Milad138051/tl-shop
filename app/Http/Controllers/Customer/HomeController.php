<?php

namespace App\Http\Controllers\Customer;

use App\Models\Market\Brand;
use Illuminate\Http\Request;
use App\Models\Content\Banner;
use App\Models\Content\Page;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $slideShowImages = Banner::where('position', 0)->where('status', 1)->get();
        $topBanners = Banner::where('position', 1)->where('status', 1)->take(2)->get();
        $middleBanners = Banner::where('position', 2)->where('status', 1)->take(2)->get();
        $bottomBanner = Banner::where('position', 3)->where('status', 1)->first();
        $brands = Brand::where('status',1)->get();
        $mostVisitedProducts = Product::latest()->take(10)->get();
        $offerProducts = Product::latest()->take(10)->get();
        return view('customer.home', compact('slideShowImages', 'topBanners', 'middleBanners', 'bottomBanner', 'brands', 'mostVisitedProducts', 'offerProducts'));
    }
	
	public function products(Request $request,ProductCategory $category=null)
	{
		//sorting
		switch($request->sort){
			
		    case "1":
            $column='created_at';
            $direction='DESC';
            break;	
		
            case "2":
                $column = "price";
                $direction = "DESC";
                break;
            case "3":
                $column = "price";
                $direction = "ASC";
                break;
            case "4":
                $column = "viewed";
                $direction = "DESC";
                break;
            case "5":
                $column = "sold_number";
                $direction = "DESC";
                break;
            default:
                $column = "created_at";
                $direction = "ASC";
        }
		//	
		//selection productCtegory
		if($category){
		$productModel=$category->products();
		}else{
		$productModel=new Product();
		}
		//
		//search by name
		if($request->search){
			$baseQuery=$productModel->where('name','LIKE',"%".$request->search."%")->orderBy($column,$direction);
		}else{
            $baseQuery=$productModel->orderBy($column, $direction);
		}
		//
		//get selectedBrandsName
		if($request->brands){
			$selectedBrandsArray=[];
			$selectedBrandsColl=Brand::find($request->brands);
			foreach($selectedBrandsColl as $selectedBrandColl){
				array_push($selectedBrandsArray,$selectedBrandColl->original_name);
			}
		}else{
			$selectedBrandsArray=[];
		}
		//
		$brands=Brand::all();
		$categories=ProductCategory::whereNull('parent_id')->get();
		//mahdode price
		$products=$request->min_price && $request->max_price ? $baseQuery->whereBetween('price',[$request->min_price,$request->max_price]) :
		$baseQuery->when($request->min_price,function ($baseQuery) use ($request){
			$baseQuery->where('price','>=',$request->min_price)->get();
		})->when($request->max_price,function ($baseQuery) use ($request){
			$baseQuery->where('price','<=',$request->max_price)->get();
		})->when(!($request->min_price && $request->max_price),function ($baseQuery){
			$baseQuery->get();
		});
		//
		//filter by brands
		$products->when($request->brands,function() use ($request,$products){
			$products->whereIn('brand_id',$request->brands);
		});
		//
        
		$products = $products->paginate(4);
		
		return view('customer.market.product.products',compact('products','brands','selectedBrandsArray','categories'));
	}
	
	
	
	public function page(Page $page)
	{
		return view('customer.page',compact('page'));
	}




}
