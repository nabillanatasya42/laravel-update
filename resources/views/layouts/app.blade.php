<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('backend/img/logo/logo.png') }}" rel="icon">
    <title>Inventory Management System</title>


    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/ruang-admin.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="app">
        <div id="wrapper">


            <!-- Sidebar -->
            <nav id="sidebar" style="display: block;">
                <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
                        <div class="sidebar-brand-icon">
                            Demo POS
                        </div>
                        <div class="sidebar-brand-text mx-3"></div>
                    </a>
                    
                    <hr class="sidebar-divider my-0">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/home">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </router-link>
                    </li>
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Features
                    </div>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3" aria-expanded="true" aria-controls="collapseBootstrap3">
                            <i class="far fa fa-shopping-bag"></i>
                            <span>Manage Inventory</span>
                        </a>
                        <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="/store-product">Add Product</a>
                                <a class="collapse-item" href="/products">All Product</a>
                                <a class="collapse-item" href="/stock">Stocks</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstraporder" aria-expanded="true" aria-controls="collapseBootstraporder">
                            <i class="fab fa fa-database"></i>
                            <span>Manage Orders</span>
                        </a>
                        <div id="collapseBootstraporder" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="/today-orders">Orders List</a>
                                <a class="collapse-item" href="/pos">Add New Orders</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <!-- TopBar -->

                    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top" id="topbar" v-show="$route.path === '/' || $route.path === '/register' || $route.path === 'forget' ? false : true " >
                        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="{{ route('logout') }}" >
                                    <span class="ml-2 d-none d-lg-inline text-white small">
                                        <img class="img-profile rounded-circle" src="{{ asset('backend/img/boy.png') }}" style="max-width: 60px" />
                                        Admin Logout
                                    </span>
                                </a>
                            </li>
                        </ul>

                    </nav>
                    <!-- Topbar -->


                    <!-- Container Fluid-->
                    <div class="container-fluid" id="container-wrapper">

                        @yield('content')

                    </div>
                    <!---Container Fluid-->

                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"> </script> --}}
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  

    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('backend/js/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script>
</body>

</html>