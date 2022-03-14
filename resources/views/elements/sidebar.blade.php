<?php $paginaCorrente = $_SERVER['REQUEST_URI'];?>
<div class="wrapper">
  <div class="custom-sidebar">
    <div class="custom-sidebar-header">
      <a href="#" class="custom-sidebar-header-link">
        <img class="custom-sidebar-header-link_image" src="{{ asset('img/logo.png') }}" alt="logo">
      </a>
    </div>
    <div class="custom-sidebar-body">
      <div class="custom-sidebar-body-wrapper" id="perfect-scrollbar">
        <ul class="custom-sidebar-body-wrapper-list">
          <li class="custom-sidebar-body-wrapper-list-item <?php echo(strpos($paginaCorrente, '/inicio') !== false ) ? "active" : ''; ?>">
            <a class="custom-sidebar-body-wrapper-list-item-link" href="<?php echo url('inicio');?>">
              <i class="far fa-folder-open"></i>
              <p class="custom-sidebar-body-wrapper-list-item-link-title">Início</p>
            </a>
          </li>
          <li class="custom-sidebar-body-wrapper-list-item <?php echo(strpos($paginaCorrente, '/movimentacoes') !== false ) ? "active" : ''; ?>">
            <a class="custom-sidebar-body-wrapper-list-item-link" href="<?php echo url('movimentacoes');?>">
              <i class="fas fa-box-open"></i>
              <p class="custom-sidebar-body-wrapper-list-item-link-title">Movimentações</p>
            </a>
          </li>
          <li class="custom-sidebar-body-wrapper-list-item <?php echo(strpos($paginaCorrente, '/funcionarios') !== false ) ? "active" : ''; ?>">
            <a class="custom-sidebar-body-wrapper-list-item-link" href="<?php echo url('funcionarios');?>">
              <i class="fas fa-user"></i>
              <p class="custom-sidebar-body-wrapper-list-item-link-title">Funcionários</p>
            </a>
          </li>
          <li class="custom-sidebar-body-wrapper-list-item <?php echo(strpos($paginaCorrente, '/usuarios') !== false ) ? "active" : ''; ?>">
            <a class="custom-sidebar-body-wrapper-list-item-link" href="<?php echo url('usuarios');?>">
              <i class="fa fa-user"></i>
              <p class="custom-sidebar-body-wrapper-list-item-link-title">Administradores</p>
            </a>
          </li>
          <li class="custom-sidebar-body-wrapper-list-item active-pro">
            <a class="custom-sidebar-body-wrapper-list-item-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off"></i>
                <p class="custom-sidebar-body-wrapper-list-item-link-title">Sair</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="main-panel">
