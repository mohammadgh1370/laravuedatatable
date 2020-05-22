@extends('admin.layouts.master')

@section('page-title', 'نقش ها')
@section('path', 'نقش')
@section('location', 'ایجاد نقش')

@section('content')
    <div class="row">
        <div class="col-12">
            @can('role_create')
                <form action="{{route('admin.role.store')}}" class="row" method="post">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">نام نقش</label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                                   value="{{old('name')}}"
                                   placeholder="نام نقش را وارد کنید، برای مثال: writer">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="label">برچسب نقش</label>
                            <input class="form-control @error('label') is-invalid @enderror" name="label" type="text"
                                   value="{{old('label')}}"
                                   placeholder="برچسب نقش را وارد کنید، برای مثال: نویسنده">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="guard_name">نوع کاربر</label>
                            <select class="form-control @error('guard_name') is-invalid @enderror" name="guard_name">
                                <option>نوع کاربر را انتخاب کنید</option>
                                @foreach($guards as $guard)
                                    <option value="{{$guard}}">{{$guard}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="guard_name">مجوزها</label>
                            <select-search :options="{{json_encode($permissions)}}"
                                           name="permission_id"
                                           key-option="label"
                                           key-data="id"
                                           classes="@error('permission_id') is-invalid @enderror"
                                           placeholder="مجوز را انتخاب کنید"
                                           :multiple="true"></select-search>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5">
                        <button class="btn btn-block btn-primary">تایید</button>
                    </div>

                </form>
            @endcan
        </div>
    </div>
@endsection