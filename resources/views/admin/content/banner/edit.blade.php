@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش بنر</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بنر</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش بنر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                       ویرایش بنر
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.banner.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

               <section>
                    <form action="{{ route('admin.content.banner.update',$banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
						@method('PUT')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان بنر</label>
                                    <input type="text" class="form-control form-control-sm" name="title" value="{{ old('title',$banner->title) }}">
                                </div>
                                @error('title')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>
							
						<section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="url">آدرس URL</label>
                                <input type="text" name="url" class="form-control form-control-sm" value="{{old('url',$banner->url)}}">
                            </div>
							   @error('url')

                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>

                            @enderror
                        </section>


                        <section class="col-12 mb-3">
                            <div class="form-group">
                                <label for="image">تصویر</label>
                                <input type="file" class="form-control form-control-sm" name="image" id="image">
                            </div>
							  <img src="{{ asset($banner->image) }}" alt="" width="100" height="50" class="mt-3">
                            @error('image')

                           <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>

                            @enderror
                        </section>
				
					
					   <section class="col-12 mb-3">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm" id="status">
                                    <option value="0" @if(old('status',$banner->status)==0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('status',$banner->status)==1) selected @endif>فعال</option>
                                </select>
                            </div>

                            @error('status')

                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>

                            @enderror
                        </section>
						
										
					   <section class="col-12 mb-3">
                            <div class="form-group">
                                <label for="position">جایگاه</label>
						 
    	     					<select name="position"  class="form-control form-control-sm">
                                    <option value="">یک مورد را انتخاب کنید</option>
                                    @foreach ($positions as $key=> $position)
                                    <option value="{{ $key }}" @if(old('position',$banner->position) == $key) selected @endif>{{ $position }}
									</option>
                                    @endforeach
                                </select>


                            </div>

                            @error('position')

                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>

                            @enderror
                        </section>

                       

                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection
