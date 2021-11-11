<!doctype html>
<html lang="{{ Config('app.locale') }}">

<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Admin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <!-- Bootstrap core CSS     -->
    <link href="http://localhost/TheMySpot/admin_theme/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="http://localhost/TheMySpot/admin_theme/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="http://localhost/TheMySpot/admin_theme/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="http://localhost/TheMySpot/admin_theme/assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src='http://fonts.googleapis.com/css?family=Roboto:400,700,300' type='text/css'></script>
    <link href="http://localhost/TheMySpot/admin_theme/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <style>
    .navbar .navbar-nav{font-size: 27px; top: 1px;}
    .navbar-nav p{margin: 2px;}
    
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="azure"
		data-image="http://localhost/TheMySpot/admin_theme/assets/img/sidebar-5.jpg">

			    	<div class="sidebar-wrapper">
			            <div class="logo">
			                <a href="{{url('/vagas')}}" class="simple-text">
			                MySpot
			                </a>
			            </div>

			            <ul class="nav">
			                <li class="active">
			                    <a href="{{url('/admin')}}">
			                        <i class="pe-7s-graph"></i>
			                        <p> Menu</p>
			                    </a>
			                </li>

			                <li>
			                    <a href="{{url('/admin/vagas')}}">
			                        <i class="pe-7s-graph3"></i>
			                        <p>Exibir Vagas</p>
			                    </a>
			                </li>

											<li>
												 <a href="{{url('/admin/addVagas')}}">
														 <i class="pe-7s-plus"></i>
														 <p>Adicionar Vagas</p>
												 </a>
										 </li>

			            </ul>
			    	</div>

    </div>


    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
										 data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/admin')}}">  <i class="pe-7s-home"> </i> Gerenciar Vagas</a>
                </div>
                <div class="collapse navbar-collapse">
                  

                    <ul class="nav navbar-nav navbar-right">
                    <li>
                            <a href="{{url('/encontrarAmigos')}}">
                                <p>Encontrar Amigos</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/requests')}}">
                                <p>Pedidos de Amizade({{App\friendships::where('status',0)
                                ->where('user_requested', Auth::user()->id)
                                ->count()}})</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/vagas')}}">
                                <p>Encontrar Vagas</p>
                            </a>
                        </li>
                       
                       <!--Amigos-->
                       <li>
                            <a href="{{ url('/amigos')}}"><i class="fa fa-users fa-2x" aria-hidden="true"  ></i></a>
                            </li>
                            <!--Mensagens-->
                            <li>
                            <a href="{{ url('/novasMensagens')}}"><i class="far fa-comment-alt fa-2x"></i></a>
                            </li>
                           <!--Notificações-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                                    role="button" aria-expanded="false">
                                    <i class="fa fa-globe fa-2x" aria-hidden="true"></i>
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
                            <li>
                            <a href="{{ url('/amigos')}}"></a>
                            </li>
                        
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


     @yield('content')


       

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="http://localhost/TheMySpot/admin_theme/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="http://localhost/TheMySpot/admin_theme/assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="http://localhost/TheMySpot/admin_theme/assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="http://localhost/TheMySpot/admin_theme/assets/js/chartist.min.js" type="text/javascript"></script>

    <!--  Notifications Plugin    -->
    <script src="http://localhost/TheMySpot/admin_theme/assets/js/bootstrap-notify.js"></script>

   

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="http://localhost/TheMySpot/admin_theme/assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="http://localhost/TheMySpot/admin_theme/assets/js/demo.js"></script>

	
</html>
