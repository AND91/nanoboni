@include('elements.header')
@include('elements.sidebar')
@include('elements.navbar')
<div class="row">
        <div class="col-md-12">
          <div class="card card-user">
            <div class="card-header">
              <h5 class="card-title text-center">Saldo: {{ $employee->bank_balance }}</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('updateEmployee') }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-6 pl-md-1">
                    <div class="form-group">
                        <label for="name">{{ __('Nome') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $employee->name }}" required autocomplete="name" autofocus>
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
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $employee->login }}" required autocomplete="email">
                          <div class="col-md-12">
                            @error('email')
                              <span class="text-danger" role="alert">{{ $message }}</span>
                            @enderror
                          </div>
                    </div>
                  </div>
                </div>
                <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title" style="display: block;">Movimentações</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="" class="table table-striped">
                  <thead class=" text-primary">
                    <th>Tipo</th>
                    <th>Quantidade</th>
                    <th>Observação</th>
                    <th>Administrador</th>
                    <th>Data de Movimentação</th>
                  </thead>
                  <tbody>
                    @foreach ($transactions as $row):
                      <tr>
                        <td>{{ $row->type }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>{{ $row->note }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->updated_at)->format('d/m/Y H:i:s') }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" name="register_user" class="btn btn-primary btn-round float-md-right float-sm-right float-xs-right">Atualizar</button>
                    <input type="hidden" name="id_employee" value="{{ $employee->id }}">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@include('elements.footer')
