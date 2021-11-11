@extends('profile.master')

@section('content')

<div class="container">
<ol class="breadcrumb">
            <li><a href="{{url('/vagas')}}">Menu</a></li>
            <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Perfil</a></li>
            <li><a href="{{url('/editarPerfil')}}">Editar Perfil</a></li>
            <li><a href="">Mudar imagem</a></li>
        </ol> 



    <div class="row">

    @include('profile.barraLateral')    

        <div class="col-md-9" style="margin-right: 500px; margin-left: 150px;">
            <div class="panel panel-default">
                <div class="panel-heading">{{Auth::user()->name}}</div>

                <div class="panel-body">
                <div class="col-md-4">
                      Este é o seu perfil!<br>

                        <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="100px" height="100px"/><br>
                        <br>
                        <hr>
                   

                        <form action="{{url('/')}}/uploadImg" method="post" enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                           <input type="file" name="pic" class="form-control" required/>
                           <input type="submit" class="btn btn-success" name="btn"/>
                        </form>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
