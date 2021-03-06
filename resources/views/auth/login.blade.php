@extends('layouts.auth')
@section('styles')
    <style>
    body {
    background-image: url("../storage/assorted-fresh-fruits-868110.jpg");
    }</style>
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image" style="max-height: 750px;">

            </div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <h3 class="login-heading mb-4">Firsatyeri'ne Hoşgeldiniz!</h3>
                                <form method="POST" action="{{route('login')}}">
                                    {{ csrf_field() }}
                                    <div class="form-label-group">
                                        <input type="email" name="email" id="inputEmail" class="form-control"
                                               placeholder="Email adresiniz.." required autofocus>
                                        <label for="inputEmail">Email</label>
                                        @if($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-label-group">
                                        <input  type="password" name="password" id="inputPassword" class="form-control"
                                               placeholder="Şifreniz.." required>
                                        <label for="inputPassword">Şifre</label>
                                        @if($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <button
                                        class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"
                                        type="submit">Giriş
                                    </button>
                                    <div class="text-center">
                                        Hesabınız mı yok? Hemen ücretsiz <a class="small" href="{{route('register')}}"> hesap açın</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="#">Şifremi unuttum</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
