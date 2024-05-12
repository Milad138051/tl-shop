<header class="header-main">
    <!--// بخش ابی-->
    <section class="sidebar-header bg-gray">
        <section class="d-flex justify-content-between flex-md-row-reverse px-2">
            <span id="sidebar-toggle-hide" class="d-none d-md-inline pointer">
                <i class="fas fa-toggle-off"></i>
            </span>
            <span id="sidebar-toggle-show" class="d-inline d-md-none pointer">
                <i class="fas fa-toggle-on"></i>
            </span>
            <span><img class="logo" src="{{asset('admin-assets/images/logo.png')}}"></span>
            <span id="menu-toggle" class="d-md-none"><i class="fas fa-ellipsis-h"></i></span>
        </section>
    </section>
    <!--// بخش سفید-->
    <section class="body-header" id="body-header">
        <section class="d-flex justify-content-between">
            <!--// بخش راست-->
            <section>
                <!--// بخش سرج-->
                <span class="mr-5">
                    <span id="search-area" class="search-area d-none">
                        <i id="search-area-hide" class="fas fa-times pointer"></i>
                        <input type="text" id="search-input" class="search-input">
                        <i class="fas fa-search pointer"></i>
                    </span>
                    <i id="search-toggle" class="fas fa-search p-1 d-none d-md-inline pointer"></i>
                </span>
                <!--// بخش فول اسکرین-->
                <span id="full-screen" class="pointer p-1 d-none d-md-inline mr-5">
                    <i id="screen-compress" class="fas fa-compress d-none"></i>
                    <i id="screen-expand" class="fas fa-expand"></i>
                </span>
            </section>
            <!--// بخش چپ-->
            <section>
                <!--// نوتیفیکیشن ها-->
                <span class="ml2 ml-md-4 position-relative">
                    <!--// ایکونش-->
                    <span class="pointer">
                        <i id="header-notification-toggle" class="fas fa-bell"></i>
						
                        @if($notifications->count() !==0)
                    <sup class="badge badge-danger">{{$notifications->count()}}</sup>
				        @endif
                    </span>
                    <!--// باکس نوتیفیکشن ها-->
                    <section id="box-header-notification" class="box-header-notification rounded">
                        <!--// هدرش-->
                        <section class="d-flex justify-content-between">
                            <span class="px-2">نوتیفیکیشن ها</span>
                            <span class="px-2">
                                <span class="badge badge-danger">جدید</span>
                            </span>
                        </section>
                        <!--// بدنه باکس نوتیفیکیشن ها-->
                        <section class="header-notification-wrapper">
                            <ul class="list-group rounded px-0">
                             <!--هر نوتیفیکیشن//-->
							 @foreach($notifications as $notification)
                              <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <section class="media-body pr-1">
                                        <p class="notification-text">{{$notification['data']['message']}}</p>
                                    </section>
                                </section>
                            </li>
							@endforeach
                        </ul>
                        </section>
                    </section>
                </span>
                <!--// کامنت ها-->
                <span class="ml2 ml-md-4 position-relative">
                    <!--// ایکونش-->
                <span id="header-comment-toggle" class="pointer">
                    <i class="far fa-comment-alt"></i>
					@if($unseenComments->count() !==0)
                    <sup class="badge badge-danger">{{$unseenComments->count()}}</sup>
				    @endif
                </span>
                    <!--// باکس کامنت ها-->
                    <section id="box-header-comment" class="box-header-comment rounded">
                        <!--// input ...-->
                        <section class="border-bottom px-4">
                            <input type="text" class="form-control form-control-sm my-4" placeholder="جستجو">
                        </section>
                        <!--// بدنه باکس کامنت ها-->
                        <section class="header-comment-wrapper">
                            <ul class="list-group rounded px-0">
                                <!--// هر کامنت-->
								@foreach($unseenComments as $item)
                                <li class="list-group-item list-group-item-action">
								<a @if($item->commentable_type=='App\Models\Content\Post') href="{{route('admin.content.comment.show',$item->id)}}" @else href="{{route('admin.market.comment.show',$item->id)}}"  @endif>
                                    <section class="media">
                                        <section class="media-body pr-1">
                                            <section class="d-flex justify-content-between">
                                            <h5 class="comment-user">{{$item->user->name}}</h5>
                                                <span>
												{{$item->body}}
												<i class="fas fa-circle text-success comment-user-status"></i>
												</span>
                                            </section>
 							            </section>
                                    </section>
									</a>
                                </li>
								@endforeach
                            </ul>
                        </section>
                    </section>
                </span>
                <!--// پروفایل-->
                <span class="ml-3 ml-md-5 position-relative">
                    <!--// عکس و متنش-->
                    <span id="header-profile-toggle" class="pointer">
                        <img class="header-avatar" src="{{asset('admin-assets/images/avatar-2.jpg')}}" alt="avatar">
                        <span class="header-user-name">میلاد</span>
                        <i class="fas fa-angle-down"></i>
                    </span>
                    <!--// باکس پروفایل-->
                    <section id="header-profile" class="header-profile rounded">
                        <section class="list-group rounded">

                        <!--// هر گزینه پروفایل-->
                        <a class="list-group-item list-group-item-action header-profile-link" href="">
                            <i class="fas fa-cog"></i>
                            تنظیمات
                        </a>

                         <a class="list-group-item list-group-item-action header-profile-link" href="">
                            <i class="fas fa-user"></i>
                            کاربر
                        </a>

                         <a class="list-group-item list-group-item-action header-profile-link" href="">
                            <i class="fas fa-envelope"></i>
                            پیام ها
                        </a>

                         <a class="list-group-item list-group-item-action header-profile-link" href="">
                            <i class="fas fa-lock"></i>
                            قفل صفحه
                        </a>

                         <a class="list-group-item list-group-item-action header-profile-link" href="">
                            <i class="fas fa-cog"></i>
                            تنظیمات
                        </a>

                         <a class="list-group-item list-group-item-action header-profile-link" href="">
                            <i class="fas fa-sign-out-alt"></i>
                            خروج
                        </a>
                    </section>
                    </section>
                </span>
            </section>
        </section>
    </section>
</header>
