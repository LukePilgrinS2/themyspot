    @extends('profile.master')

    @section('content')

    <div class="container">
        <ol class="breadcrumb">
                <li><a href="{{url('/vagas')}}">Menu</a></li>
                
                <li><a href="">Pedidos de Amizade</a></li>
            </ol>       
        <div class="row">
            @include('profile.barraLateral')    
            <div class="col-md-9" style="margin-right: 500px; margin-left: 150px;">
                <div class="panel panel-default">
                    <div class="panel-heading">{{Auth::user()->name}}</div>

                    <div class="panel-body">
                        <div class="col-sm-12 col-md-12">
                        
                        @if (session()->has('msg'))
                                 <p class="alert alert-success">
                                     {{session()->get('msg')}}
                                </p>  
                        @endif

                        @foreach($FriendRequests as $uList)

                            <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                <div class="col-md-2 pull-left">
                                    <img src="{{url('../')}}/public/img/{{$uList->pic}}" width="80px" height="80px" class="img-circle"/>
                                </div>    
                             <div class="col-md-7 pull-left">
                                 <h3 style="margin:0px;"><a href="">{{ucwords($uList->name)}}</a></h3>
                                <br>    
                                 <p><b>E-mail:</b> {{$uList->email}}</p>    
                             </div>    
                             <div class="col-md-3 pull-right">
                             
                                <p>
                                     <a href="{{url('/aceitar')}}/{{$uList->name}}/{{$uList->id}}" class="btn btn-info btn-sm">Confirmar</a>

                                     <a href="{{url('/removerPedido')}}/{{$uList->id}}" class="btn btn-default btn-sm">Remover</a>
                                </p>
                           </div>
                </div>
                @endforeach 
            </div>
         </div>
       </div>
     </div>
  </div>
  </div>
    @endsection
