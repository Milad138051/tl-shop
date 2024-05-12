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
                            <section class="content-header-link m-2">
                                <a href="{{route('customer.profile.my-tickets.create')}}">
								 <i class="btn btn-success text-white">
								ارسال تیکت جدید
								 </i>
								</a>
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->


               <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نویسنده تیکت</th>
                            <th>عنوان تیکت</th>
                            <th>دسته تیکت</th>
                            <th>اولویت تیکت</th>
                            <th>وضعیت تیکت </th>
                            <th>تیکت مرجع</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
					@foreach($tickets as $ticket)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td>{{$ticket->user->fullname}}</td>
                            <td>{{$ticket->subject}}</td>
                            <td>{{$ticket->category->name}}</td>
                            <td>{{$ticket->priority->name}}</td>
                            <td>{{$ticket->status==0 ?'باز' :'بسته'}}</td>
                            <td>{{$ticket->parent ? $ticket->parent->subject : 'ندارد'}}</td>
                            <td class="width-16-rem text-left">
                               
							   <a href="{{ route('customer.profile.my-tickets.show',$ticket->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>

								 <a href="{{ route('customer.profile.my-tickets.change', $ticket->id) }}" class="btn btn-{{ $ticket->status == 1 ? 'success' : 'danger' }} btn-sm"><i class="{{ $ticket->status == 1 ? 'fa fa-check' : 'btn-close' }} check"></i>
                                </a>
                            </td>
                        </tr>
					@endforeach

                    </tbody>
                </table>
            </section>

        


                </section>
            </main>
        </section>
    </section>
@endsection
