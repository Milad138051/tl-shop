@extends('admin.layouts.master')

@section('head-tag')
<title>رنگ کالا</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کالاها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">رنگ کالا</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                 رنگ کالا
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.product-color.create',$product->id) }}" class="btn btn-info btn-sm">ایجاد رنگ کالای جدید </a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover h-150px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کالا</th>
                            <th>نام رنگ</th>
                            <th>رنگ</th>
                            <th>افزایش قیمت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->colors as $color)

                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $color->color_name }}</td>
                            <td>
  							 <span style="border-radius:40%;width:20px;height:20px;background:{{$color->color}};display:block;border:1px solid gray"></span>
							</td>
                            <td>{{ $color->price_increase }} تومان</td>
                           
						
						 <td width=100px>
                                        <form action="{{route('admin.market.product-color.destroy',$color->id)}}" method="POST">
										@csrf
										@method('DELETE')
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