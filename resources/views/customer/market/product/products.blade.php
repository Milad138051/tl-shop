@extends('customer.layouts.master-one-col')


@section('content')



<!-- start body -->
<section class="">
    <section id="main-body-two-col" class="container-xxl body-container">
        <section class="row">
          @include('customer.layouts.partials.products-sidebar')

			
			
            <main id="main-body" class="main-body col-md-9">
                <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                    <section class="filters mb-3">
					@if(request()->search)
                        <span class="d-inline-block border p-1 rounded bg-light">
						نتیجه جستجو برای : 
						  <span class="badge bg-info text-dark">"{{request()->search}}"</span>
						</span>
					@endif
					
					@if(request()->brands)
						<span class="d-inline-block border p-1 rounded bg-light">
						برند : 
						  <span class="badge bg-info text-dark">"{{implode(',',$selectedBrandsArray)}}"</span>
						</span>
					@endif
					
					@if(request()->categories)
                        <span class="d-inline-block border p-1 rounded bg-light">
						دسته : 
						  <span class="badge bg-info text-dark">"-"</span>
						</span>
					@endif
					
					@if(request()->min_price)
                        <span class="d-inline-block border p-1 rounded bg-light">قیمت از : 
						  <span class="badge bg-info text-dark">{{request()->min_price}} تومان</span>
						</span>
					@endif
					
					@if(request()->max_price)
                        <span class="d-inline-block border p-1 rounded bg-light">قیمت تا : 
						  <span class="badge bg-info text-dark">{{request()->max_price}} تومان</span>
						</span>
					@endif

                    </section>

							@if(request()->category)					
					        <h2 class="content-header-title content-header-title-small">
							کالاهای موجود در دسته : {{request()->category->name}} 
                            </h2>
							@else
						    <h2 class="content-header-title content-header-title-small">
							همه کالاها 
                            </h2>
							@endif
												
                    <section class="sort">
                        <span>مرتب سازی بر اساس : </span>
                        <a href="{{route('customer.products',['search'=>request()->serach,'sort'=>'1','min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}" class="btn btn {{request()->sort==1 ? 'btn-info' :''}} btn-sm px-1 py-0">جدیدترین</a>
                        <a href="{{route('customer.products',['search'=>request()->serach,'sort'=>'2','min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}" class="btn btn {{request()->sort==2 ? 'btn-info' :''}}  btn-sm px-1 py-0">گران ترین</a>
                        <a href="{{route('customer.products',['search'=>request()->serach,'sort'=>'3','min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}" class="btn btn {{request()->sort==3 ? 'btn-info' :''}}  btn-sm px-1 py-0">ارزان ترین</a>
                        <a href="{{route('customer.products',['search'=>request()->serach,'sort'=>'4','min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}" class="btn btn {{request()->sort==4 ? 'btn-info' :''}}  btn-sm px-1 py-0">پربازدیدترین</a>
                        <a href="{{route('customer.products',['search'=>request()->serach,'sort'=>'5','min_price'=>request()->min_price,'max_price'=>request()->max_price,'brands'=>request()->brands,'category'=>request()->category])}}" class="btn btn {{request()->sort==5 ? 'btn-info' :''}}  btn-sm px-1 py-0">پرفروش ترین</a>
                    </section>


                    <section class="main-product-wrapper row my-4">


                        @forelse ($products as $product)
                        <section class="col-md-3 p-0">
                            <section class="product">
                                <section class="product-add-to-cart">
							
							{{-- <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"> --}}
									{{-- 	<i class="fa fa-cart-plus"></i> --}}
								{{-- </a> --}}


								</section>
                                @guest
                                    <section class="product-add-to-favorite position-relative" style="top: 0">
                                        <button type="button" class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                        </section>
                                        @endguest
                                        @auth
                                            @if ($product->user->contains(auth()->user()->id))
                                            <section class="product-add-to-favorite position-relative" style="top: 0">
                                                <button type="button" class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی">
                                                    <i class="fa fa-heart text-danger"></i>
                                                </button>
                                            </section>
                                            @else
                                            <section class="product-add-to-favorite position-relative" style="top: 0">
                                                <button type="button" class="btn btn-light btn-sm text-decoration-none" data-url="{{ route('customer.market.add-to-favorite', $product) }}" data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه به علاقه مندی">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            </section>
                                            @endif
                                        @endauth
                                <a class="product-link" href="{{route('customer.market.product',$product)}}">
                                    <section class="product-image">
                                        <img class="" src="{{ asset($product->image['indexArray']['medium']) }}" alt="">
                                    </section>
                                    <section class="product-colors"></section>
                                    <section class="product-name">
                                        <h3>{{ $product->name }}</h3>
                                    </section>
                                    <section class="product-price-wrapper">
                                        <section class="product-price">{{ number_format($product->price) }} تومان</section>
                                    </section>
                                </a>
                            </section>
                        </section>
                        @empty
                        <h1 class="text-danger">محصولی یافت نشد</h1>
                        @endforelse


                        <section class="col-12">
                            <section class="my-4 d-flex justify-content-center">
                                <nav>
								{{$products->links('pagination::bootstrap-5')}}
                                </nav>
                            </section>
                        </section>

                    </section>


                </section>
            </main>
        </section>
    </section>
</section>
<!-- end body -->




@endsection

@section('script')
	
<script>
    $('.product-add-to-favorite button').click(function() {
       var url = $(this).attr('data-url');
       var element = $(this);
       $.ajax({
           url : url,
           success : function(result){
            if(result.status == 1)
            {
                $(element).children().first().addClass('text-danger');
                $(element).attr('data-original-title', 'حذف از علاقه مندی ها');
                $(element).attr('data-bs-original-title', 'حذف از علاقه مندی ها');
            }
            else if(result.status == 2)
            {
                $(element).children().first().removeClass('text-danger')
                $(element).attr('data-original-title', 'افزودن از علاقه مندی ها');
                $(element).attr('data-bs-original-title', 'افزودن از علاقه مندی ها');
            }
            else if(result.status == 3)
            {
                $('.toast').toast('show');
            }
           }
       })
    })
</script>

@endsection
