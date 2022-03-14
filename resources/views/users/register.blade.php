@include('elements.header')
@include('elements.sidebar')
@include('elements.navbar')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Cadastrar usuário</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="row">
                <div class="col-md-4 pl-md-1">
                  <div class="form-group">
                      <label for="name">{{ __('Nome') }}</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      <div class="col-md-12">
                          @error('name')
                              <span class="text-danger" role="alert">
                                {{ $message }}
                              </span>
                          @enderror
                      </div>
                  </div>
                </div>
                <div class="col-md-4 px-md-1">
                  <div class="form-group">
                      <label for="email" class="">{{ __('E-mail') }}</label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        <div class="col-md-12">
                          @error('email')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                          @enderror
                        </div>
                  </div>
                </div>
                <div class="col-md-4 pr-md-1">
                  <div class="form-group">
                      <label for="profile" class="">{{ __('Perfil') }}</label>
                      <select class="form-control" name="profile" id="profile" required>
                        <option value=""></option>
                        @foreach ($type_register as $row)
                          <option value="{{ $row->profile }}">{{ $row->description }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>



              <div class="row">
                <div class="col-md-6 pl-md-1">
                  <div class="form-group">
                      <label for="password">{{ __('Senha') }}</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      <div class="col-md-12">
                          @error('password')
                              <span class="text-danger" role="alert">
                                {{ $message }}
                              </span>
                          @enderror
                      </div>
                    </div>
                  </div>

                <div class="col-md-6 pr-md-1">
                  <div class="form-group">
                    <label for="password-confirm">{{ __('Confirmar Senha') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary  float-right">
                        {{ __('Cadastrar') }}
                    </button>
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@include('elements.footer')
