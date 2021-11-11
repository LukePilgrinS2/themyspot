@extends('profile.master')

@section('content')

<div class="container">
<ol class="breadcrumb">
            <li><a href="{{url('/vagas')}}">Menu</a></li>
           
            <li><a href="">Mensagens</a></li>
        </ol>  
</div>
<div class="col-md-12 " >
<div style="background-color:#fff" class="col-md-3 pull-left">
<div class="row" style="padding:10px">
<div class="col-md-6"><b>Todas as Mensagens</b></div>
       <div class="col-md-5">
         <a href="{{url('/novasMensagens')}}" class="btn btn-sm btn-info">Iniciar nova Conversa</a>
       </div>
    </div>
     
    
    <div v-for="msgPrivada in msgPrivada">
    <li @click="mensagens(msgPrivada.id)"style="list-style:none; margin-top:10px; background-color:#F3F3F3" v-on:click="seen = true" class="row">
        <div class="col-md-3 pull-left">
        <img :src="'http://localhost/TheMySpot/public/img/' + msgPrivada.pic"
                    style="width:50px; border-radius:100%; margin:5px">
        </div>
        <div class="col-md-9 pull-left" style="margin-top:5px">       
            <b> @{{msgPrivada.name}}</b><br>
            <p style="font-size:12px">Clique aqui para continuar a conversa</p>
        </div>
    </li>
    </div>
    <hr>
</div>

<div style="background-color:#fff; min-height:600px; border-left:5px solid #F5F8FA; float:center" v-on:click="seen = true" class="col-md-7" >
    <h3 align="center">Mensagens</h3>
    <p class="alert alert-success"><b>Para começar a conversar com seus amigos clique em iniciar nova conversa</b></p>

    <div v-for="msgSolo in msgSolo">
        <div v-if="msgSolo.user_from == <?php echo Auth::user()->id; ?>">
        <div class="col-md-12 pull-right" style="margin-top:10px">
        <img :src="'http://localhost/TheMySpot/public/img/' + msgSolo.pic"
                    style="width:30px; border-radius:100%; margin-left:5px" class="pull-left">
            <div style="float:left; background-color:#F0F0F0; padding:5px 15px 5px 15px; margin-left:5px;
             text-align:right; color:#333; border-radius:10px" class="pull-left" >
                   @{{msgSolo.msg}}
           </div>
        </div>
      </div>
        <div v-else>
        <div class="col-md-12" style="margin-top:10px">
        <img :src="'http://localhost/TheMySpot/public/img/' + msgSolo.pic"
                    style="width:30px; border-radius:100%; margin-left:5px" class="pull-right">
        <div style="float:right; background-color:#0084ff; padding:5px 15px 5px 15px; margin-left:5px; 
         text-align:right; color:#fff; border-radius:10px" >
                 @{{msgSolo.msg}}
           </div>
        </div>
        </div>
    </div>
    <hr>
    <div  v-if="seen">
    <input type="hidden" v-model="conID">
    <textarea class="col-md-12 form-control" v-model="msgFrom"
    style="margin-top:15px; border:none"></textarea><br><br>
    <input type="button" value="Enviar mensagem" @click="enviarMsg()"><br><br>
</div>
</div>
</div>

@endsection