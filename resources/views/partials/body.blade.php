
@include('partials.header')

<body class="layout-3">
    <div id="app">
      <div class="main-wrapper container">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
      <a href="index.html" class="navbar-brand sidebar-gone-hide">Simple Cashier</a>
      <div class="navbar-nav">
          <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar">
              <i class="fas fa-bars"></i>
          </a>
      </div>
      <div class="nav-collapse">
          <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
              <i class="fas fa-ellipsis-v"></i>
          </a>
      </div>
  </nav>
    <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link"><i class="far fa-food"></i><span>Food</span></a>
                </li>
    
                <li class="nav-item ">
                    <a href="{{ route('transaction.index') }}" class="nav-link"><i class="far fa-transaction"></i><span>Transaksi</span></a>
                </li>
            </ul>
      </div>
    </nav>
    {{-- active --}}
        <!-- Main Content -->
    @yield('content')

    @include('partials.footer')

</body>
</html>




