    @extends('profile.master')

    @section('content')

    <div class="container">
        <ol class="breadcrumb">
                <li><a href="{{url('/vagas')}}">Menu</a></li>
               
                <li><a href="">Encontrar Amigos</a></li>
            </ol>       
        <div class="row">
            @include('profile.barraLateral')    
            <div class="col-md-9" style="margin-right: 500px; margin-left: 150px;">
                <div class="panel panel-default">
                    <div class="panel-heading">{{Auth::user()->name}}</div>

                    <div class="panel-body">
                        <div class="col-sm-12 col-md-12">
                            @foreach($allUsers as $uList)

                            <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                <div class="col-md-2 pull-left">
                                    <img src="{{url('../')}}/public/img/{{$uList->pic}}" width="80px" height="80px" class="img-circle"/>
                                </div>    
                             <div class="col-md-7 pull-left">
                                 <h3 style="margin:0px;"><a href="{{url('/profile')}}/{{$uList->slug}}">{{ucwords($uList->name)}}</a></h3>
                                 <p><i class="fa-globe"></i> {{$uList->cidade}} - {{$uList->estado}}</p>
                                 <p>{{$uList->info}}</p>    
                             </div>    
                             <div class="col-md-3 pull-right">

                             <?php
                             $check = DB::table('friendships')
                                      ->where('user_requested', '=', $uList->id)
                                      ->where('requester', '=', Auth::user()->id)
                                      ->first();
                             $check2 = DB::table('friendships')
                                      ->where('requester', '=', $uList->id)
                                      ->where('user_requested', '=', Auth::user()->id)
                                      ->first();         
                                if($check =='' && $check2 =='') {
                             ?>        

                                 <p>
                                     <a href="{{url('/')}}/adicionarAmigo/{{$uList->id}}"
                                     class="btn btn-info btn-sm">Adicionar como Amigo</a>
                                </p>  
                                
                                <?php } else { 
                                
                                    if($check != '') { ?>
                                    <b><p>Pedido enviado</p></b> 
                                    <?php };
                                    if($check2 != '') { ?>
                                    <b><p>Este usuário já lhe enviou um pedido</p> </b>
                                   
                            <?php }  }?>
                            
                    </div>
                </div>
                @endforeach
            </div>
         </div>
       </div>
     </div>
  </div>
    @endsection
