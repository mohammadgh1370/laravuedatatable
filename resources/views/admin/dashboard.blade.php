@extends('admin.layouts.master')

@section('page-title', 'داشبورد')
@section('path', 'داشبورد')
@section('location', 'داشبورد')

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$adminCount}}</h3>

                    <p>ادمین ها</p>
                </div>
                <div class="icon p-1">
                    <i class="fa fa-user-secret"></i>
                </div>
                <a href="{{route('admin.admin.index')}}" class="small-box-footer">
                    اطلاعات بیشتر
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$userCount}}</h3>

                    <p>کاربران</p>
                </div>
                <div class="icon p-1">
                    <i class="fa fa-user"></i>
                </div>
                <a href="{{route('admin.user.index')}}" class="small-box-footer">
                    اطلاعات بیشتر
                    <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$adminCount}}</h3>

                    <p>ادمین ها</p>
                </div>
                <div class="icon p-1">
                    <i class="fa fa-user-secret"></i>
                </div>
                <a href="#" class="small-box-footer">
                    اطلاعات بیشتر
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$userCount}}</h3>

                    <p>کاربران</p>
                </div>
                <div class="icon p-1">
                    <i class="fa fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">
                    اطلاعات بیشتر
                    <i class="fa fa-arrow-circle-left"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-8">
            {{--			<chart :chart="{{json_encode($chart)}}"></chart>--}}
        </div>

        <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
                <span class="info-box-icon"><i class="fa fa-tag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">فهرست</span>
                    <span class="info-box-number">5,200</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fa fa-heart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">برگزیده‌ها</span>
                    <span class="info-box-number">92,050</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon"><i class="fa fa-cloud-download"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">دانلود</span>
                    <span class="info-box-number">114,381</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="fa fa-comment"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">پیام مستقیم</span>
                    <span class="info-box-number">163,921</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <div class="card card-success border border-success">
                <div class="card-header">
                    <h3 class="card-title">آخرین کاربران</h3>

                    <div class="card-tools">
                        {{--						<span class="badge badge-danger p-1">8 پیام جدید</span>--}}
                        <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="users-list">
                        {{--						@foreach($users as $user)--}}
                        {{--							<li>--}}
                        {{--								<img src="{{$user->avatar}}" alt="{{$user->full_name}}">--}}
                        {{--								<p class="users-list-name mt-2 m-0">{{$user->full_name}}</p>--}}
                        {{--								<span class="users-list-date">{{$user->timeago}}</span>--}}
                        {{--							</li>--}}
                        {{--						@endforeach--}}
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    {{--					<a href="{{route('admin.customer.index')}}">مشاهده همه کاربران</a>--}}
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>
@endsection
