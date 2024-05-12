@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش نقش</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
	        <li class="breadcrumb-item font-size-12"> <a href="#">سطوح دسترسی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">نقش ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">ویرایش نقش</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ویرایش نقش
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.user.role.update',$role->id) }}" method="POST">
				@csrf
				@method('PUT')
                    <section class="row">

                        <section class="col-12 col-md-5">
                            <div class="form-group">
                                <label for="">عنوان نقش</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="{{old('name',$role->name)}}">
                            </div>
							
                            @error('name')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </section>
						
						
						
                        <section class="col-12 col-md-5">
                            <div class="form-group">
                                <label for="">توضیح نقش</label>
                                <input type="text" name="description" class="form-control form-control-sm" value="{{old('description',$role->description)}}">
                            </div>
							
                            @error('description')
                            <span class="alert_required bg-danger p-1 text-white rounded" role="alert">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-2">
                            <button class="btn btn-primary btn-sm mt-md-4">ثبت</button>
                        </section>
						
						
                                <section class="col-12">
                          
						  <section class="row border-top mt-3 mr-4 py-3">
					 	  دسترسی ها :<br>
						  
						
						  		 @foreach ($role->permissions as $key => $permission)
								 
								 {{$permission->name}} <br>
								 
								 @endforeach
								 
						  </section>

                                 </section>

                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
