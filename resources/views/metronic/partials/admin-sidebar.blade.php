@php use App\Models\Tenant;use Illuminate\Support\Facades\Route; @endphp
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <li class="menu-item menu-item-submenu @if(Route::is('admin.dashboard.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">داشبورد</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">داشبورد</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.dashboard.dashboard')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.dashboard.dashboard') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">داشبورد</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.daily-logs.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">حضور و غیاب</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">حضور و غیاب</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.daily-logs.index')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.daily-logs.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">حضور و غیاب</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.properties.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">املاک</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">املاک</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.properties.index')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.properties.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">املاک</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.tenants.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">مدیریت تجاری/اداری ها</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">مدیریت تجاری/اداری ها</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.tenants.index')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.tenants.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">لیست تجاری/اداری ها</span>
                            </a>
                        </li>
                        <li class="menu-item @if(Route::is('admin.tenants.create')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.tenants.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">ایجاد کاربر</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.others.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">مدیریت متفرقه ها</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">مدیریت متفرقه ها</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.others.index')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.others.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">لیست متفرقه ها</span>
                            </a>
                        </li>
                        <li class="menu-item @if(Route::is('admin.tenants.create')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.others.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">ایجاد متفرقه</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.complex-settings.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">تنظیمات کلی مجموعه</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">مدیریت طبقه ها</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.complex-settings.floors.index')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.complex-settings.floors.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">لیست طبقه ها</span>
                            </a>
                        </li>
                        <li class="menu-item @if(Route::is('admin.complex-settings.settings.index')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.complex-settings.settings.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">بدهی ها</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.fiscal-years.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">سال مالی</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">مدیریت طبقه ها</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.fiscal-years.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.fiscal-years.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">لیست سال های مالی</span>
                            </a>
                        </li>
                        <li class="menu-item @if(Route::is('admin.fiscal-years.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.fiscal-years.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">ایجاد سال مالی</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.coupons.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">کوپن های تخفیف</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">کوپن های تخفیف</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.coupons.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.coupons.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">لیست کوپن های تخفیف</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.transactions.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">تراکنش ها</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">تراکنش ها</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.transactions.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.transactions.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">لیست تراکنش ها</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.warnings.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">اخطار ها</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">اخطار ها</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.warnings.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.warnings.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">لیست اخطار ها</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.complex-settings.message-groups.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">اطلاعیه ها</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">اطلاعیه ها</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.complex-settings.message-groups.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.complex-settings.message-groups.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">لیست اطلاعیه ها</span>
                            </a>
                        </li>
                        <li class="menu-item @if(Route::is('admin.complex-settings.message-groups.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.complex-settings.message-groups.create-send-to-all') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">ارسال اطلاعیه به همه</span>
                            </a>
                            <a href="{{ route('admin.complex-settings.message-groups.create-floor') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">ارسال اطلاعیه به طبقه خاص</span>
                            </a>
                            <a href="{{ route('admin.complex-settings.message-groups.create-tenant-type') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">ارسال اطلاعیه به گروه کاربری</span>
                            </a>
                            <a href="{{ route('admin.complex-settings.message-groups.create-single-tenant') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">ارسال اطلاعیه به پلاک</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu @if(Route::is('admin.exports.*')) menu-item-active menu-item-open @endif" aria-haspopup="true" data-menu-toggle="hover">
                <a class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Layout / Layout-4-blocks</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    <span class="menu-text">خروجی اکسل</span>
                    <i class="menu-arrow"></i></a>
                <div class="menu-submenu " style="" kt-hidden-height="400">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item  menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">خروجی اکسل</span>
                            </span>
                        </li>
                        <li class="menu-item @if(Route::is('admin.exports.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.exports.hazine-omrani') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">خروجی هزینه های عمرانی</span>
                            </a>
                        </li>
                        <li class="menu-item @if(Route::is('admin.exports.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.exports.debt') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">خروجی بدهی ها</span>
                            </a>
                        </li>
                        <li class="menu-item @if(Route::is('admin.exports.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.exports.other-debt') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">خروجی بدهی متفرقه ها</span>
                            </a>
                        </li>
                        <li class="menu-item @if(Route::is('admin.exports.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.exports.power-outage') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">خروجی قطع برق</span>
                            </a>
                        </li>
                        <li class="menu-item @if(Route::is('admin.exports.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.transactions.index', ['transaction_type' => 'malekiati']) }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">خروجی مالکیتی</span>
                            </a>
                        </li>
                        <li class="menu-item @if(Route::is('admin.exports.*')) menu-item-active @endif" aria-haspopup="true">
                            <a href="{{ route('admin.transactions.index', ['transaction_type' => 'motefareghe']) }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span></i>
                                <span class="menu-text">خروجی متفرقه</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
