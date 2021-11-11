@extends('profile.master')

@section('content')
 

<div class="container">
    <ol class="breadcrumb">
            <li><a href="{{url('/vagas')}}">Menu</a></li>
           
            <li><a href="{{url('/Vagas')}}">Vagas</a></li>
        </ol>       

    <div class="row">
        
        <div class="col-md-9" style="margin-right: 500px; margin-left: 150px;">
            <div class="panel panel-default">
                <div class="panel-heading">{{Auth::user()->name}}, achamos que você talvez se interesse por estas vagas |  
                <a href="{{url('vagas')}}">Todas as vagas</a>
                </div>

                <div class="panel-body">
                    <div class="col-sm-12 col-md-12 jobDetails">
                    
                    @if (session()->has('msg'))
                             <p class="alert alert-success">
                                 {{session()->get('msg')}}
                            </p>  
                    @endif

                    @foreach($vagas as $vaga)

           

                    <h4 >
                      <b>{{$vaga->name_user}}</b> disponibilizou <b>{{$vaga->titulo_vaga}}</b>
                    </h4>

                    <div class="row job_company">

                      <!--<div class="col-md-2 pull-left">
                      <img src="http://localhost/TheMySpot/public/img/{{$vaga->pic_user}}" class="img-rounded" style="width:100px; height:100px; margin:5px; border:1px solid #ddd; padding:5px">
                      </div>-->

                      <div class="col-md-10 pull-left">
                        <h3 style="font-size:18px; color:green"> =====
                          {{ucwords($vaga->info_contato)}} =====</h3>
                          <!--<small>{{$vaga->email_user}}</small>-->
                        
                      </div>

                    </div>

                        <div class="col-md-12" >
                          <h3 class="job_point">
                          Requisitos: </h3>
                          <p>{{$vaga->requisitos}}</p>
                        </div>

                        <div class="col-md-12" >
                          <h3 class="job_point">
                          Habilidades: </h3>
                          <p>{{$vaga->skills}}</p>
                        </div>


                        <div class="col-md-12" >
                          <h3 class="job_point">
                          Empresa contratante: </h3>
                          <p>{{$vaga->nome_empresa}}</p>
                        </div>

                        <div class="col-md-12" >
                          <h3 class="job_point">
                          Número de vagas: </h3>
                          <p>{{$vaga->num_vagas}}</p>
                        </div>

                        <div class="col-md-12" >
                          <h3 class="job_point">
                          Nível de presença necessária: </h3>
                          <p>{{$vaga->presença}}</p>
                        </div>

                        <?php 
                        function inverteData($data){
                          if(count(explode("/",$data)) > 1){
                              return implode("-",array_reverse(explode("/",$data)));
                          }elseif(count(explode("-",$data)) > 1){
                              return implode("/",array_reverse(explode("-",$data)));
                          }
                      } ?>
                        <div class="col-md-12" >
                          <h3 class="job_point">
                          Data de publicação: </h3>
                          <p><?php echo inverteData($vaga->created_at) ?></p>
                        </div>

                        
                        <div class="col-md-12" >
                          <h3 class="job_point">
                          Como se candidatar: </h3>
                          <p>Entre em contato e envie seu portifolio para este número ou e-mail:
                          <a href="{{$vaga->info_contato}}" class="email_link">{{$vaga->info_contato}}</a></p>
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