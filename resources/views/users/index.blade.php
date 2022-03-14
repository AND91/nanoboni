@include('elements.header')
@include('elements.sidebar')
@include('elements.navbar')

<div class="row">
  <div class="col-md-12">
    <div class="custom-container">
      <div class="container-header container-lateral">
        <div class="header-box">
          <i class="fas fa-archive box-icon"></i>
          <h4 class="box-title">Usuários</h4>
        </div>
        <div class="button-box">
          <a class="button b-green" href="{{ url('usuarios/cadastrar') }}">Criar usuario</a>
        </div>
      </div>
      <div class="container-body">
        <div class="row">
          <div class="col-lg col-12 container-box">
            <div class="custom-card">
              <table class='table table-striped w-100' id="tabelaUm">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th></th>
                  </tr>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $row)
                    <tr>
                      <td>{{ $row->name }}</td>
                      <td>{{ $row->email }}</td>
                      <td>
                        <a href="{{ url('usuarios/detalhe', $row->id) }}">
                          <i class="fa fa-search"></i>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('elements.footer')
