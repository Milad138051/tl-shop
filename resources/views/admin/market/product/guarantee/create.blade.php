@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد گارانتی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کالا </a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد گارانتی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد گارانتی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
            </section>

            <section>
                <form action="{{ route('admin.market.guarantee.store', $product->id) }}" method="post">
                    @csrf
                    <section class="row">
					
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">نام گارانتی</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm">
                            </div>
                            @error('name')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">افزایش قیمت</label>
                                <input type="text" name="price_increase" value="{{ old('price_increase') }}" class="form-control form-control-sm">
                            </div>
                            @error('price_increase')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                      </section>
					  
					     <section class="col-12 p-0">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>


                  </form>
                     
              </section>
              
            </section>

        </section>
    </section>

@endsection