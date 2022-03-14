@include('elements.header')
@include('elements.sidebar')
@include('elements.navbar')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-user">
        <div class="card-header">
          <h5 class="card-title">Cadastrar movimentação</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('registerTransaction') }}">
              @csrf

              <div class="row">
              <div class="col-md-4 pl-md-1">
                  <div class="form-group">
                      <label for="type" class="">{{ __('Tipo') }}</label>
                      <select class="form-control" name="type" id="type" required>
                        <option value=""></option>
                        <option value="E">Entrada</option>
                        <option value="S">Saída</option>
                      </select>
                  </div>
                </div>
                <div class="col-md-4 pl-md-1">
                  <div class="form-group">
                      <label for="employee">{{ __('Funcionário') }}</label>
                      <select class="form-control" name="employee" id="employee" required>
                        <option value=""></option>
                        @foreach ($employees as $row)
                          <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="col-md-4 px-md-1">
                  <div class="form-group">
                      <label for="quantity" class="">{{ __('Quantidade') }}</label>
                      <input id="quantity" type="quantity" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required autocomplete="quantity">
                        <div class="col-md-12">
                          @error('quantity')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                          @enderror
                        </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label for="note">{{ __('Observação') }}</label>
                      <textarea name="note" class="form-control" id="" cols="30" rows="10" required></textarea>
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
