							<span class="sidebar-nav-item-title">
					
					               <a href="{{route('customer.products',['search'=>request()->serach,'sort'=>request()->sort,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands])}}" class="d-inline">
						                 همه
						           </a>	
						    </span>
							
							
							
                 		   @foreach($categories as $category)
							<span class="sidebar-nav-item-title">
						
							@if($category->products->count() > 0)
						           <a href="{{route('customer.products',['category'=>$category->id,'search'=>request()->search ? request()->search : null,'sort'=>request()->sort,'min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands])}}" class="d-inline">
						                 {{$category->name}}
						           </a>
								   @else  
						           <span class="d-inline">
						                 {{$category->name}}    
							       </span>	      
			                @endif						  
						
							@if($category->children->count() > 0)
							<i class="fa fa-angle-left"></i>
						    @endif
							
							</span>
						@include('customer.layouts.partials.sub-categories',['categories'=>$category->children])
							@endforeach
                            
							
							
			