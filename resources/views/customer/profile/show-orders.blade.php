@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>جزییات سفارش</title>
@endsection

@section('content')
    <section id="main-body-two-col" class="container-xxl body-container">
        <section class="row">
 
        @include('customer.layouts.partials.profile-sidebar')
            <main id="main-body" class="main-body col-md-9">
                <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>جزییات سفارش با کد :{{$order->id}}</span>
                            </h2>
                        </section>
                    </section>
                    <!-- end vontent header -->
					
				<section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>نام محصول</th>
                            <th>دسته محصول</th>
                            <th>تعداد</th>
                            <th>عکس</th>
                            <th>رنگ</th>
                            <th>گارانتی</th>
                            <th>تخفیف فروش شگفت انگیز</th>
                            <th>قیمت</th>
                            <th>قیمت مجموع</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($order->orderItems as $orderItem)

                            <tr>
                                <td>{{$orderItem->singleProduct->name}}</td>
                                <td>{{$orderItem->singleProduct->category->name}}</td>
                                <td>{{$orderItem->number}}</td>
                                <td>
								<img src="{{asset($orderItem->singleProduct->image['indexArray']['medium'])}}" width="40px" height="40px">
								</td>
                                <td>
								@if($orderItem->color)
								 <span style="border-radius:40%;width:10px;height:10px;background:{{$orderItem->color->color}};display:inline-block;border:1px solid gray">
							     </span>
								 @else
								 ندارد
							    @endif
								</td>
                                <td>{{$orderItem->guarantee ? $orderItem->guarantee->name :'ندارد' }}</td>
                                <td>{{$orderItem->amazing_sale_id ? json_decode($orderItem->amazing_sale_object)->percentage.' درصد' :'ندارد' }} 
								</td>
                                <td>{{priceFormat($orderItem->final_product_price)}} تومان</td>
                                <td>{{priceFormat($orderItem->final_total_price)}} تومان</td>
                               
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </section>
				
				  <section class="col-md-12">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                @php
                                    $totalProductPrice = 0;
                                    $totalDiscount = 0;
                                @endphp

                                @foreach ($order->orderItems as $orderItem)
                                    @php
                                        $totalProductPrice += $orderItem->final_total_price ;
                                        $totalDiscount += $order->order_discount_amount * $orderItem->number;
                                    @endphp
                                @endforeach

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها ({{ $order->orderItems->count() }})</p>
                                    <p class="text-muted">
									<span id="total_product_price">{{ priceFormat($totalProductPrice) }}</span> تومان
                                    </p>
                                </section>
		                      <section class="border-bottom mb-3"></section>

								
								 @if ($order->commonDiscount != null)
									
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">میزان تخفیف عمومی</p>
                                    <p class="text-danger fw-bolder"><span
                                            id="total_discount">{{ priceFormat($order->commonDiscount->percentage) }}</span> درصد</p>
                                </section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">میزان حداکثر تخفیف عمومی</p>
                                    <p class="text-danger fw-bolder"><span
                                            id="total_discount">{{ priceFormat($order->commonDiscount->discount_ceiling) }}</span> تومان</p>
                                </section>
				               <section class="border-bottom mb-3"></section>
                                @endif 
		

                                @if ($totalDiscount != 0)
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالاها</p>
                                        <p class="text-danger fw-bolder"><span
                                                id="total_discount">{{ priceFormat($totalDiscount) }}</span> تومان</p>
                                    </section>
                                <section class="border-bottom mb-3"></section>

                                @endif
								
								  @if ($order->copan != null)
			                   <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">میزان تخفیف کد تخفیف</p>
                                    <p class="text-danger fw-bolder"><span id="total_discount">{{ priceFormat($order->copan->amount) }}
									@if($order->copan->amount_type==0)
										درصدی
									@elseif($order->copan->amount_type==1)
									تومان
									@endif
									</span> 
									</p>
                                </section>						
                               @endif
                                <section class="border-bottom mb-3"></section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">مجموع سفارش</p>
                                    <p class="fw-bolder"><span
                                            id="total_price">{{ priceFormat($order->order_final_amount) }}</span>
                                        تومان</p>
                                </section>

                            </section>
                </section>
            </main>
        </section>
    </section>
@endsection
