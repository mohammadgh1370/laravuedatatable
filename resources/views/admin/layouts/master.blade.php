@extends('layouts.app')
@section('class', 'sidebar-mini')
@section('page-title', __('admin panel'))

@section('css')

@endsection

@section('main')
    <div class="wrapper">
        <!-- Navbar -->
    {{--    @include('admin.layouts.navbar')--}}
    @include('admin.layouts.navbar')
    <!-- /.navbar -->

        <!-- Main Sidebar Container -->
    @include('admin.layouts.sidebar')
    {{--    @include('admin.layouts.sidebar')--}}

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('page-title', 'صفحه سریع')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="#">@yield('path', 'خانه')</a></li>
                                <li class="breadcrumb-item active">@yield('location', 'صفحه سریع')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        @include('layouts.partials.sidebar-control')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('layouts.partials.footer')
    </div>
@endsection

@section('js')
    <script src="{{asset('panel/admin/js/admin.js')}}"></script>
@endsection