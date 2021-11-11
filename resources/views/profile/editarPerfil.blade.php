@extends('profile.master')

@section('content')

<div class="container">
    <ol class="breadcrumb">
            <li><a href="{{url('/vagas')}}">Menu</a></li>
           
            <li><a href="">Editar Perfil</a></li>
        </ol>       
    <div class="row">
        @include('profile.barraLateral')    
        <div class="col-md-9"style="margin-right: 500px; margin-left: 150px;">
            <div class="panel panel-default">
                <div class="panel-heading">{{Auth::user()->name}}</div>

                    <div class="panel-body">
                    <div class="col-sm-12 col-md-12" >
                                <div class="thumbnail">
                                <h3 align="center">{{ucwords(Auth::user()->name)}}</h3>
                                <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="120px" height="120px" class="img-circle"/>
                                    <div class="caption">
                                        <p align="center">{{$data->cidade}} - {{$data->estado}}</p>
                                        <p align="center"><a href="{{url('/')}}/mudarImg" class="btn btn-primary" role="button">Mudar Imagem</a></p>
                                    </div>
                                </div>
                            </div>

                        <div class="col-sm-12 col-md-12">
                         
                          <form action="{{url('/updatePerfil')}}" method="post">
                          <input type="hidden" name="_token" value="{{csrf_token()}}"/>  

                          <div class="col-md-6">

                            <div class="input-group">
                                <span id="basic-addonl">Cidade</span>
                                <input type="text" class="form-control" name="cidade" value="{{$data->cidade}}">
                            </div> 
                            <br>
                            <div class="input-group">
                                <span id="basic-addonl">Estado</span>
                                <input type="text" class="form-control"  name="estado" value="{{$data->estado}}">
                            </div> 
            
                          </div>  
                          <div class="col-md-6">

                                <div class="input-group">
                                    <span id="basic-addonl">Sobre</span>
                                    <textarea type="text" class="form-control" rows="8" name="info">{{$data->info}}</textarea>
                                </div> 
                                 <br>

                            <div class="input-group">
                                <input type="submit" class="btn btn-success pull-left">
                            </div> 
                           </div>  
                          </form>
                       </div>       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
