@extends('admin.layouts.master')

@section('page-title', 'مجوز ها')
@section('path', 'مجوز')
@section('location', 'ایجاد مجوز')

@section('content')
    <div class="row">
        <div class="col-12">
            @can('permission_create')
                <form action="{{route('admin.permission.store')}}" class="row" method="post">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">نام مجوز</label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                                   value="{{old('name')}}"
                                   placeholder="نام مجوز را وارد کنید، برای مثال: admin_index">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="label">برچسب مجوز</label>
                            <input class="form-control @error('label') is-invalid @enderror" name="label" type="text"
                                   value="{{old('label')}}"
                                   placeholder="توضیح مجوز را وارد کنید، برای مثال: لیست مدیران">
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

                    <div class="col-md-12 mt-5">
                        <button class="btn btn-block btn-primary">تایید</button>
                    </div>

                </form>
            @endcan
        </div>
    </div>
@endsection