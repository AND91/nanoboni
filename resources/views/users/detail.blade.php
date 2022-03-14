@include('elements.header')
@include('elements.sidebar')
@include('elements.navbar')
<div class="row">
        <div class="col-md-12">
          <div class="card card-user">
            <div class="card-header">
              <h5 class="card-title">Detalhe usuário</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('updateUser') }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-12">
                    <label for="">Código de venda: {{ $user->referral_code }}</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                        <label for="name">{{ __('Nome') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                        <div class="col-md-12">
                            @error('name')
                                <span class="text-danger" role="alert">
                                  {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                        <label for="email" class="">{{ __('E-mail') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                          <div class="col-md-12">
                            @error('email')
                              <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                          </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                        <label for="profile" class="">{{ __('Perfil') }}</label>
                        <select class="form-control" name="profile" id="profile" required>
                          <option value=""></option>
                          @foreach ($type_register as $row)
                            <option value="{{ $row->profile }}" {{ $user->profile == $row->profile? 'selected' : '' }}>{{ $row->description }}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6 pr-md-1">
                    <div class="form-group">
                        <label for="password">{{ __('Senha') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                        <div class="col-md-12">
                            @error('password')
                                <span class="text-danger" role="alert">
                                  {{ $message }}
                                </span>
                            @enderror
                        </div>
                      </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" name="register_user" class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right">Atualizar</button>
                    <input type="hidden" name="id_user" value="{{ $user->id }}">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@include('elements.footer')
