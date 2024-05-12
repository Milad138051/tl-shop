@extends('admin.layouts.master')

@section('head-tag')
<title>تخفیف عمومی </title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">تخفیف ها </a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> تخفیف عمومی </li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    تخفیف عمومی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            <a href="{{ route('admin.market.discount.commonDiscount.create') }}" class="btn btn-info btn-sm">ایجاد تخفیف عمومی</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>درصد تخفیف</th>
                            <th>سقف تخفیف </th>
                            <th> عنوان مناسبت</th>
                            <th>تاریخ شروع </th>
                            <th> شروع پایان</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach($commonDiscounts as $commonDiscount)
                        <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$commonDiscount->percentage}}%</td>
                            <td>{{$commonDiscount->discount_ceiling}} تومان</td>
                            <td>{{$commonDiscount->title}}</td>
                            <td>{{jalaliDate($commonDiscount->start_date)}}</td>
                            <td>{{jalaliDate($commonDiscount->end_date)}}</td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.market.discount.commonDiscount.edit', $commonDiscount->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                
								<form class="d-inline" action="{{ route('admin.market.discount.commonDiscount.delete', $commonDiscount->id) }}" method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                                    </form>
                            
							</td>
                        </tr>
						@endforeach
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection


@section('script')
   
   @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
