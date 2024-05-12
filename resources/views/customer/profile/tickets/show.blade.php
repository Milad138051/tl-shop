@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>تیکت های شما</title>
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
                                <span>تاریخچه تیکت های شما</span>
                            </h2>
                        </section>
                    </section>
                    <!-- end vontent header -->


                      <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                        <a href="{{ route('customer.profile.my-tickets') }}" class="btn btn-info btn-sm">بازگشت</a>
                      </section>

             <section class="card mb-3">
                <section class="card-header text-white bg-info">
                     {{$ticket->user->fullname}} 
                </section>
                <section class="card-body">
                    <h5 class="card-title">
					{{$ticket->subject}}
                    </h5>
                    <p class="card-text">
					{{$ticket->description}}
                    </p>
                </section>
				
				 @if($ticket->file()->count() > 0)
                            <section class="card-footer">
                                <a class="btn btn-success" href="{{ asset($ticket->file->file_path) }}" download>دانلود
                                    ضمیمه</a>
                            </section>
                            @endif
             </section>
			 
                        <hr>




                        <div class="border my-2">
                            @foreach ($ticket->children->sortBy('id') as $child)

                            <section class="card m-4">
                                <section class="card-header bg-{{ $child->reference_id==null ? 'info ' : 'light ' }}d-flex justify-content-between">
								
                                   <div> 
								   @if($child->reference_id == null) {{$child->user->fullName}} @else {{$child->ticketAdmin->user->fullName}} @endif
								   </div>
								   
                                    <small>{{ jdate($child->created_at) }}</small>
                                </section>
                                <section class="card-body">
                                    <p class="card-text">
                                        {{ $child->description }}
                                    </p>
                                </section>
								
								 @if($child->file()->count() > 0)
                            <section class="card-footer">
                                <a class="btn btn-success" href="{{ asset($child->file->file_path) }}" download>دانلود
                                    ضمیمه</a>
                            </section>
                                 @endif
                            </section>
                            @endforeach
                        </div>



             <section>
                <form action="{{route('customer.profile.my-tickets.answer',$ticket->id)}}" method="post" enctype="multipart/form-data">
				@csrf
                    <section class="row">
                        <section class="col-12">
                            <div class="form-group">
                                <label for="description">پاسخ تیکت</label>
                               ‍<textarea class="form-control form-control-sm"name="description" id="description" rows="4"></textarea>
                            </div>
							 @error('description')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>
						
						
                                    <section class="col-12 my-2">
                                        <div class="form-group">
                                            <label for="file">فایل</label>
                                            <input type="file" class="form-control form-control-sm" name="file"
                                                id="file">
                                        </div>
                                        @error('file')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                        @enderror
                                    </section>
						
						
                        <section class="col-12 m-2">
                            <button class="btn btn-primary btn-sm">ارسال</button>
                        </section>
                    </section>
                </form>
             </section>
            </main>
        </section>
    </section>
@endsection
