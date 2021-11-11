<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/f214784ec5.js" crossorigin="anonymous"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>







    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>    
    <style>
    .panel-body{min-height: 400px}
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::check())
                        <li><a href="{{ url('/encontrarAmigos')}}">Encontrar Amigos</a></li>
                        <li><a href="{{ url('/requests')}}">Pedidos de amizade 
                            <span style = "color:green; font-weight:bold; font-size:16px">({{App\friendships::where('status',0)
                                ->where('user_requested', Auth::user()->id)
                                ->count()}})</span></a></li>  
                        <li><a href="{{ url('/vagas')}}">Encontrar Vagas</a></li> 
                        <li> <a href="{{url('admin')}}"  
                        style="background-color:#283E4A; color:#fff; padding:5px 15px 5px 15px; border-radius:5px; margin:8px">Gerenciar Vagas</a></li>       
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Cadastre-se</a></li>
                        @else
                    
                        
                        <!--Amigos-->
                            <li>
                            <a href="{{ url('/amigos')}}"><i class="fa fa-users fa-2x" aria-hidden="true" title="Amigos"></i></a>
                            </li>
                             <!--Mensagens-->
                            <li>
                            <a href="{{ url('/novasMensagens')}}"><i class="far fa-comment-alt fa-2x" title="Envie Mensagens"></i></a>
                            </li>
                           <!--Notificações-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                                    role="button" aria-expanded="false">
                                    <i class="fa fa-globe fa-2x" aria-hidden="true" title="Notificações"></i>
                                    <span class="badge"
                                       style="background:red; position: relative; top: -10px; left:-10px">
                                       {{App\notifications::where('status', 1) 
                                            ->where('user_hero', Auth::user()->id)
                                            ->count()}}
                                    </span>
                                </a>
                                <?php
                                $notes = DB::table('users')
                                        ->rightJoin('notifications', 'users.id', 'notifications.user_logged')
                                        ->where('user_hero', Auth::user()->id)
                                        ->where('status', 1)
                                        ->orderBy('notifications.created_at', 'desc')
                                        ->get();
                                ?>        
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($notes as $note)
                                    <a href="{{url('/notifications')}}/{{$note->id}}">
                                    <li>
                                 <div class="row" style="min-width:400px">
                                    <div class="col-md-2"> 
                                        <img src="{{url('../')}}/public/img/{{$note->pic}}"
                                        style="width:43px; margin:7px; min-width:10px" class="img-circle">
                                       </div>
                                    <div class="col-md-9"> 
                                     
                                     <b style="color:green">{{ucwords($note->name)}}</b> 
                                      <span style="color:#000">{{$note->note}}</span>
                                       </div>
                                       </div>
                                    </li></a>
                                    @endforeach
                            </ul>
                        </li>
                         <!--Menu-->
                         <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="30px" height="30px" class="img-circle"/>
                                 <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                  
                                <li><a href="{{ url('profile') }}/{{Auth::user()->slug}}">Perfil</a></li>
                                <li><a href="{{ url('editarPerfil') }}">Editar perfil</a></li>

                                <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Sair
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li> 
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="../public/js/profile.js"></script>
</body>
</html>
