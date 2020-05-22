@extends('admin.layouts.master')

@section('page-title', 'ادمین ها')
@section('path', 'ادمین')
@section('location', 'همه')

@section('content')
    <div class="row">
        <div class="col-12">
            @can('admin_index')
                <data-table @vue_props($props)></data-table>
            @endcan
        </div>
    </div>
@endsection