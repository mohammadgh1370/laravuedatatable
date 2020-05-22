@extends('admin.layouts.master')

@section('page-title', 'کاربران')
@section('path', 'کاربر')
@section('location', 'همه')

@section('content')
    <div class="row">
        <div class="col-12">
            @can('user_index')
                <data-table @vue_props($props)></data-table>
            @endcan
        </div>
    </div>
@endsection