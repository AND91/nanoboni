@include('elements.header')
@include('elements.sidebar')
@include('elements.navbar')

<div class="row">
  <div class="col-md-12">
    <div class="custom-container">
      <div class="container-header container-lateral">
        <div class="header-box">
          <i class="fas fa-archive box-icon"></i>
          <h4 class="box-title">Movimentações</h4>
        </div>
        <div class="button-box">
          <a class="button b-green" href="{{ url('movimentacoes/cadastrar') }}">Criar movimentação</a>
        </div>
      </div>
      <div class="container-body">
        <div class="row">
          <div class="col-lg col-12 container-box">
            <div class="custom-card">
              <table class='table table-striped w-100' id="tabelaUm">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Funcionário</th>
                    <th>Valor</th>
                    <th>Criado em</th>
                  </tr>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transactions as $row)
                    <tr>
                      <td>{{ $row->id }}</td>
                      <td>@if($row->type =='E') Entrada @else Saída @endif</td>
                      <td>{{ $row->employee }}</td>
                      <td>{{ $row->quantity }}</td>
                      <td>{{ $row->created_at }}</td>
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
