@extends('admin.layouts.master')

@section('page-title', 'نقش ها')
@section('path', 'نقش')
@section('location', 'همه')

@section('content')
    <div class="row">
        <div class="col-12">
            @can('permission_create')
                <a href="{{route('admin.role.create')}}"
                   class="btn btn-success btn-sm float-left mb-4">
                    ایجاد نقش
                    <i class="fa fa-plus"></i>
                </a>
            @endcan
        </div>
        <div class="col-12">
            @can('role_index')
                <data-table @vue_props($props)></data-table>
            @endcan
        </div>
    </div>
@endsection