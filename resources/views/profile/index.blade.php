@extends('profile.master')

@section('content')
    
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{url('/vagas')}}">Menu</a></li>
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Perfil</a></li>
    </ol>
    <div class="row">

     

@foreach($userInfo as $uInfo)
     
        <div class="col-md-8" style="margin-right: 500px; margin-left: 200px;" >
            <div class="panel panel-default" >
                <div class="panel-heading">{{$uInfo->name}}</div>

                <div class="panel-body">
                    <div class="row">
                        
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                            <h3 align="center">{{$uInfo->name}}</h3>
                            <img src="{{url('../')}}/public/img/{{$uInfo->pic}}" width="120px" height="120px" class="img-circle"/>
                                <div class="caption">
                                    <p align="center">{{$uInfo->cidade}} - {{$uInfo->estado}}</p>
                                    @if ($uInfo->user_id  ==  Auth::user()->id)
                                    <p align="center"><a href="{{url('/editarPerfil')}}"
                                     class="btn btn-primary" role="button">Editar perfil</a></p>
                                    @endif 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <h4 class=""><span class="label label-default">Sobre</span></h4>
                            <p> {{$uInfo->info}}</p>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
