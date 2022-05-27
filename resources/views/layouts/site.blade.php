<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$title}}</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="{{asset('css/main.css?v=1628755089081')}}">

  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}"/>
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}"/>
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>
  <script src="https://kit.fontawesome.com/8a5e08d92d.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{asset('css/app.css')}}" />

  <meta name="description" content="Admin One - free Tailwind dashboard">

  <meta property="og:url" content="https://justboil.github.io/admin-one-tailwind/">
  <meta property="og:site_name" content="JustBoil.me">
  <meta property="og:title" content="Admin One HTML">
  <meta property="og:description" content="Admin One - free Tailwind dashboard">
  <meta property="og:image" content="https://justboil.me/images/one-tailwind/repository-preview-hi-res.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1920">
  <meta property="og:image:height" content="960">

  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="Admin One HTML">
  <meta property="twitter:description" content="Admin One - free Tailwind dashboard">
  <meta property="twitter:image:src" content="https://justboil.me/images/one-tailwind/repository-preview-hi-res.png">
  <meta property="twitter:image:width" content="1920">
  <meta property="twitter:image:height" content="960">

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
      <li class="active">
        <a href="{{route('index')}}">
          <span class="icon"><i class="fa-solid fa-house"></i></span>
          <span class="menu-item-label">Início</span>
        </a>
      </li>
    </ul>
    <p class="menu-label">Modulos</p>
    <ul class="menu-list">
      <li class="--set-active-forms-html">
        <a href="{{route('inactive')}}">
          <span class="icon"><i class="fa-solid fa-box-archive"></i></span>
          <span class="menu-item-label">Arquivo Inativo</span>
        </a>
      </li>
      <li class="--set-active-forms-html">
        <a href="{{route('employee')}}">
          <span class="icon"><i class="fa-solid fa-users"></i></span>
          <span class="menu-item-label">Servidores</span>
        </a>
      </li>
      <li class="--set-active-profile-html">
        <a href="profile.html">
          <span class="icon"><i class="fa-solid fa-address-book"></i></span>
          <span class="menu-item-label">Livro de Ponto</span>
        </a>
      </li>
      <li>
        <a href="login.html">
          <span class="icon"><i class="fa-solid fa-file-lines"></i></span>
          <span class="menu-item-label">Ofícios</span>
        </a>
      </li>
      <li>
        <a href="login.html">
          <span class="icon"><i class="fa-solid fa-graduation-cap"></i></span>
          <span class="menu-item-label">Alunos</span>
        </a>
      </li>
    </ul>
    <p class="menu-label">relatórios</p>
    <ul class="menu-list">
      <li>
        <a href="https://justboil.me" onclick="alert('Coming soon'); return false" target="_blank" class="has-icon">
          <span class="icon"><i class="mdi mdi-credit-card-outline"></i></span>
          <span class="menu-item-label">Premium Demo</span>
        </a>
      </li>
      <li>
        <a href="https://justboil.me/tailwind-admin-templates" class="has-icon">
          <span class="icon"><i class="mdi mdi-help-circle"></i></span>
          <span class="menu-item-label">About</span>
        </a>
      </li>
      <li>
        <a href="https://github.com/justboil/admin-one-tailwind" class="has-icon">
          <span class="icon"><i class="mdi mdi-github-circle"></i></span>
          <span class="menu-item-label">GitHub</span>
        </a>
      </li>
    </ul>
  </div>
</aside>

  @yield('content')

<footer class="footer">
  <div class="flex flex-col items-center justify-between space-y-3 md:flex-row md:space-y-0">
    <div class="flex items-center justify-start space-x-3">
      <div>
        © 2022, Márcio Carvalho dos Santos
      </div>
    </div>
  </div>
</footer>
</div>

<!-- Scripts below are for demo only -->

@yield('script')

</body>
</html>
  