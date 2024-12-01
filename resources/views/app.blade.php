<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
  
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container-fluid">
            <a class="navbar-brand text-dark" href="{{ route('dashboard') }}">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav">
                    {{-- <li class="nav-item">
                        <a class="nav-link active text-dark" href="{{ route('dashboard') }}" class="">Home</a>
                    </li> --}}
                  @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('suplier'))
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('kategori.index') }}">Kategori Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('product.index') }}">Product</a>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('product.index') }}">Pesanan Distributor</a>
                    </li>
                    @endif
                    @role('distributor')
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Order</a>
                    </li>
                    @endrole
                    @role('admin')
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('user.index') }}">Management Akun</a>
                    </li>
                    @endrole
                    <li class="nav-item dropdown mx-auto ">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Keluar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <form action="{{ route('logout') }}" method="Post">
                                @csrf
                                <button type="submit" class="border-0 bg-white text-center">Logout</button>
                            </form>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                      </li>
                </ul>
                
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
       @yield('content')
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    @include('sweetalert::alert')
    @yield('script')
</body>
</html>
