@extends('profile.master')

@section('content')

<div class="container">
<ol class="breadcrumb">
            <li><a href="{{url('/vagas')}}">Menu</a></li>
           
            <li><a href="">Iniciar Nova Conversa</a></li>
        </ol>  
</div>
<div class="col-md-12 msgDiv" >

  <div style="background-color:#fff" class="col-md-3 pull-left">

    <div class="row" style="padding:10px">

       <div class="col-md-6"><b>Lista de amigos</b></div>
       <div class="col-md-5">
         <a href="{{url('/mensagens')}}" class="btn btn-sm btn-info">Conversas</a>
       </div>
    </div>

   @foreach($amigos as $friend)

   <li @click="friendID({{$friend->id}})" v-on:click="seen = true" style="list-style:none;
    margin-top:10px; background-color:#F3F3F3" class="row">

      <div class="col-md-3 pull-left">
           <img src="http://localhost/TheMySpot/public/img/{{$friend->pic}}"
         style="width:50px; border-radius:100%; margin:5px">
       </div>

      <div class="col-md-9 pull-left" style="margin-top:5px">
        <b> {{$friend->name}}</b><br>
        <small>Clique para começar a conversar com {{$friend->name}} </small>
     </div>
   </li>
   @endforeach
   <hr>
  </div>

  <div style="background-color:#fff; min-height:600px; border-left:5px solid #F5F8FA; float:center" class="col-md-7" >


   <h3 align="center">Mensagens</h3>

   <div  v-if="seen">
   <p class="alert alert-success"><b>Importante:</b> Caso outro usuário comece uma conversa com você,
 sua primeira mensagem para ele também precisa ser feita através desta página</p>
      <input type="hidden" v-model="friend_id">
      <textarea class="col-md-12 form-control" v-model="newMsgFrom"></textarea><br>
      <input type="button" value="Enviar mensagem" @click="enviarNovaMsg()">
  </div>


</div>
 

</div>


@endsection