<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SimplesBank') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="dist/jquery.maskMoney.min.js" type="text/javascript"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>

<body>
    <div id="app">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Simples Bank <i class="fas fa-hotel"></i></h3>
                {{__("Saldo atual: ")}} {{Auth::user()->bank_balance . " R$"}}
            </div>

            <ul class="list-unstyled components">

                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">{{__('Usuários')}}</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="{{route('users.index')}}">Listar Usuários</a></li>
                        <li><a href="{{route('users.create')}}">Cadastrar Usuários</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Conta
                        Bancária</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="#" id="make_draw" data-toggle="modal" data-target="#draw_modal">Sacar</a></li>
                        <li><a href="#" id="make_pay" data-toggle="modal" data-target="#pay_modal">Depositar</a></li>
                        <li><a href="#">Ver Extrato</a></li>
                    </ul>
                </li>
                <li><a href="#">Contato</a></li>
            </ul>
        </nav>
        <!--Container Main start-->
        <main id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right mr-4" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')
        </main>
    </div>

    <div id="draw_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sacar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="result">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <div id="pay_modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Depositar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="result2">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    </div>
</body>
<style>
    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

    #app {
        display: flex;
        width: 100%;
    }

    #sidebar {
        min-width: 250px;
        max-width: 250px;
        min-height: 100vh;
        background: #7386D5;
        color: #fff;
        transition: all 0.3s;
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: #6d7fcc;
    }

    #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid #47748b;
    }

    #sidebar ul p {
        color: #fff;
        padding: 10px;
    }

    #sidebar ul li a {
        padding: 10px;
        font-size: 1.1em;
        display: block;
    }

    #navbarSupportedContent ul li a {
        margin-right: 30px !important;
    }

    #sidebar ul li a:hover {
        color: #7386D5;
        background: #fff;
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
        color: #fff;
        background: #6d7fcc;
    }

    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: #6d7fcc;
    }

    #sidebar.active {
        margin-left: -250px;
    }

    a[data-toggle="collapse"] {
        position: relative;
    }

    p {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1em;
        font-weight: 300;
        line-height: 1.7em;
        color: #999;
    }

    a,
    a:hover,
    a:focus {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s;
    }

    .navbar {
        padding: 15px 10px;
        background: #fff;
        border: none;
        border-radius: 0;
        margin-bottom: 40px;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .navbar-btn {
        box-shadow: none;
        outline: none !important;
        border: none;
    }

    .line {
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #ddd;
        margin: 40px 0;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    #content {
        width: 100%;
        padding: 20px;
        min-height: 100vh;
        transition: all 0.3s;
    }


    @media (max-width: 768px) {
        #sidebar {
            margin-left: -250px;
        }

        #sidebar.active {
            margin-left: 0;
        }

        #sidebarCollapse span {
            display: none;
        }
    }
</style>
<script>
    $(document).ready(function () {

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

            $("#make_draw").click(function () {
                $.ajax({
                    url: "{{route('paydraws.create')}}",
                    method: "GET",
                    data: {
                        'transaction_id': 1
                    },

                    beforeSend:function(){
                        $('.spinner-border').css('display', 'block');
                    },

                    success: function (html) {
                        $('.spinner-border').css('display', 'none');
                        $('#result').html(html);
                    }
                })
            });

            $("#make_pay").click(function () {
                $.ajax({
                    url: "{{route('paydraws.create')}}",
                    method: "GET",
                    data: {
                        'transaction_id': 2
                    },

                    beforeSend:function(){
                        $('.spinner-border').css('display', 'block');
                    },

                    success: function (html) {
                        $('.spinner-border').css('display', 'none');
                        $('#result2').html(html);
                    }
                })
            });

            if ('{{Auth::guest()}}' === '1') {
                $('#sidebarCollapse').hide();
                $('#sidebar').addClass('active');
            }

        });
</script>

@yield('pagescript')


</html>
