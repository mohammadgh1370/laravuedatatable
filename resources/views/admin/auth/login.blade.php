@extends('layouts.app')
@section('class', 'login-page')
@section('page-title', __('Admin Panel'))

@section('main')

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{__('Login to admin panel')}}</p>

                <form action="{{route('admin.login')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="mobile" class="text-sm">{{ __('Mobile') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                            <span class="fa fa-mobile-alt fa-lg input-group-text justify-content-center"
                                  style="width: 30px;"></span>
                                </div>
                                <input type="number" name="mobile" id="mobile"
                                       class="form-control @error('mobile') is-invalid @enderror"
                                       placeholder="{{ __('Mobile') }}" value="{{old('mobile')}}">
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="password" class="text-sm">{{ __('Password') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="fa fa-lock fa-lg input-group-text justify-content-center"
                                          style="width: 30px;"></span>
                                </div>
                                <input type="password" name="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="{{ __('Password') }}">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="password" class="text-sm">{{ __('Captcha') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text justify-content-center p-0">
                                        @captcha
                                    </span>
                                </div>
                                <input type="text" id="captcha" name="captcha" autocomplete="off"
                                       class="form-control @error('captcha') is-invalid @enderror"
                                       placeholder="{{ __('Captcha') }}">
                                @error('captcha')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div>
                                <label class="check-container text-sm">
                                    <input type="checkbox">{{__('Remember me')}}
                                    <span class="check-mark"></span>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{__('Login')}}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1 mt-3">
                    <a href="#" class="float-right text-sm">{{__('Forgot Password')}}</a>

                    <a href="register.html" class="float-left text-sm">{{__('Register')}}</a>
                </p>
            </div>

            <!-- /.login-card-body -->
        </div>
    </div>

@endsection
