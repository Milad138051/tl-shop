@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد کاربر ادمین</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کاربران ادمین</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">ایجاد ادمین جدید</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد کاربر ادمین
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.user.admin-user.store')}}" method="POST" enctype="multipart/form-data">
				@csrf
                    <section class="row">

                        <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="name">نام کاربری</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value={{old('name')}}>
                            </div>
							@error('name')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </section>
						
						
						<section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">ایمیل</label>
                                <input type="text" class="form-control form-control-sm" name="email" id="email" value={{old('email')}}>
                            </div>
							@error('email')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </section>
						
						
						  <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="first_name">نام کوچک</label>
                                <input type="text" class="form-control form-control-sm" name="first_name" id="first_name" value={{old('first_name')}}>
                            </div>
							@error('first_name')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </section>
						
						
                        <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="last_name">نام خانوادگی</label>
                                <input type="text" class="form-control form-control-sm" name="last_name" id="last_name" value={{old('last_name')}}>
                            </div>
							@error('last_name')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </section>
						
						
                            <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">کلمه عبور</label>
                                <input type="password" name="password" class="form-control form-control-sm">
                            </div>
                            @error('password')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>
						
						
						
						
                    <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">تکرار کلمه عبور</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-sm">
                            </div>
                            @error('password_confirmation')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>
						
							
                     <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="mobile"> شماره موبایل</label> 
                                <input type="text" class="form-control form-control-sm"  name="mobile" id="mobile" value={{old('mobile')}}>
                            </div>
							@error('mobile')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </section>
						
						
                    <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="profile_photo_path">تصویر</label>
                                <input type="file" class="form-control form-control-sm" name="profile_photo_path" id="profile_photo_path">
                            </div>
							@error('profile_photo_path')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="status">وضعیت کاربر</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0">غیر فعال</option>
                                    <option value="1">فعال</option>
                                </select>
                            </div>
							@error('status')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </section>
						
						
						 <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="activation">وضعیت فعال سازی</label>
                                <select name="activation" id="activation" class="form-control form-control-sm">
                                    <option value="0">غیر فعال</option>
                                    <option value="1">فعال</option>
                                </select>
                            </div>
							@error('activation')
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
