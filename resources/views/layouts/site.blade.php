<!DOCTYPE html>
<html lang="pt-BR" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .dropdown:hover .dropdown-menu {
      display: block;
    }
  </style>
  <title>{{ $title ?? 'Sistema Secretaria da Escola' }}</title>

  <link rel="stylesheet" href="{{ asset('css/main.css?v=1628755089081') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
  
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}"/>
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}"/>
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>
  
  <script src="https://kit.fontawesome.com/8a5e08d92d.js" crossorigin="anonymous"></script>
  
  @yield('css')

</head>
<body>

<div id="app">
  <aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
      <div>
        Minha <b class="font-black">Secretaria</b>
      </div>
    </div>
    
    <div class="menu is-menu-main">
      <p class="menu-label">Geral</p>
      <ul class="menu-list">
        <li class="{{ request()->routeIs('index') ? 'active' : '' }}">
          <a href="{{ route('index') }}">
            <span class="icon"><i class="fa-solid fa-house"></i></span>
            <span class="menu-item-label">Início</span>
          </a>
        </li>
      </ul>

      <p class="menu-label">Módulos</p>
      <ul class="menu-list">
        <li class="{{ request()->routeIs('inactive') ? 'active' : '' }}">
          <a href="{{ route('inactive') }}">
            <span class="icon"><i class="fa-solid fa-box-archive"></i></span>
            <span class="menu-item-label">Arquivo Inativo</span>
          </a>
        </li>
        <li class="{{ request()->routeIs('employee') ? 'active' : '' }}">
          <a href="{{ route('employee') }}">
            <span class="icon"><i class="fa-solid fa-users"></i></span>
            <span class="menu-item-label">Servidores</span>
          </a>
        </li>
        <li class="{{ request()->routeIs('pointbook.index') ? 'active' : '' }}">
          <a href="{{ route('pointbook.index') }}">
            <span class="icon"><i class="fa-solid fa-address-book"></i></span>
            <span class="menu-item-label">Livro de Ponto</span>
          </a>
        </li>
        <li class="{{ request()->routeIs('oficios.*') ? 'active' : '' }}">
          <a href="#">
            <span class="icon"><i class="fa-solid fa-file-lines"></i></span>
            <span class="menu-item-label">Ofícios</span>
          </a>
        </li>
        <li class="{{ request()->routeIs('alunos.*') ? 'active' : '' }}">
          <a href="#">
            <span class="icon"><i class="fa-solid fa-graduation-cap"></i></span>
            <span class="menu-item-label">Alunos</span>
          </a>
        </li>
      </ul>

      <p class="menu-label">Relatórios</p>
      <ul class="menu-list">
        <li>
          <a href="#" class="has-icon">
            <span class="icon"><i class="fa-solid fa-chart-pie"></i></span>
            <span class="menu-item-label">Afastamentos</span>
          </a>
        </li>
        <li>
          <a href="#" class="has-icon">
            <span class="icon"><i class="fa-solid fa-print"></i></span>
            <span class="menu-item-label">Gerar Folha</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  @yield('content')

  <footer class="footer">
    <div class="flex flex-col items-center justify-between space-y-3 md:flex-row md:space-y-0">
      <div class="flex items-center justify-start space-x-3">
        <div class="text-gray-600 text-sm">
          © {{ date('Y') }}, Márcio Carvalho dos Santos </div>
      </div>
    </div>
  </footer>
</div>

@yield('script')

</body>
</html>