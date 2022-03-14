@extends('layouts.app')

@section('content')
  <section class="container login">
      <br>
      <div class="row align-centered">
        <div class="col-md-4 border-login">
          <div class="logo-image align-centered">
            <img src="{{ asset('img/logotipo.png') }}" width="350">
          </div>
          <br>

          <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="email">{{ __('E-mail') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 ">
                  @error('email')
                    <span class="text-danger" role="alert">
                        <strong>E-mail ou senha inválidos</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="password">{{ __('Senha') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  @error('password')
                    <span class="text-danger" role="alert">
                        <strong>E-mail ou senha inválidos</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  @if (Route::has('password.request'))
                      <a class="btn btn-link float-right" href="{{ route('password.request') }}">
                          {{ __('Esqueceu sua senha?') }}
                      </a>
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-5 col-xs-5">
                  <button type="submit" class="btn btn-luiza-gabrielly form-control">
                      {{ __('Login') }}
                  </button>
                </div>
              </div>
          </form>
        </div>
      </div>
      <br><br>
  </section>
@endsection
