@extends('profile.master')

@section('content')
 
<style>

.minhasVagas{list-style:none; margin:0px; padding:0px}
</style> 

<div class="container">
          

    <div class="row">
        
        <div class="col-md-9" style="margin-right: 500px; margin-left: 150px;">
            <div class="panel panel-default">
            <div class="panel-heading"><h4><span style="color:green">{{ucwords(Auth::user()->name)}}</span>, 
            Você talvez se interesse por estas vagas</h4>     </div>

                <div class="panel-body">
                         @if ( session()->has('msg') )
                         <p class="alert alert-success">
                                      {{ session()->get('msg') }}
                                   </p>
                                @endif
                  @foreach($vagas as $vaga)
                  <div class="col-md-10 minhasVagas">
                        <a href="{{url('vaga')}}/{{$vaga->id}}">    
                        <div class="thumbnail">     
                                <div class="caption">
                                    
                                <li> <?php $skills = explode(',',$vaga->skills)?>
                                <b>{{$vaga->id}} -</b> {{$vaga->titulo_vaga}}<br>
                                @foreach($skills as $skill)
                                <div style="background-color:#283E4A; color:#fff; margin-top:5px; border-radius:10px; width:100%; float:left; padding:3px 15px 3px 15px">{{$skill}}</div>

                                @endforeach
                                  <a href="{{url('vaga')}}/{{$vaga->id}}" style="margin-top:10px; width:100%" class="btn btn-primary">Detalhes</a>
                                </li>
                                </div>
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

          