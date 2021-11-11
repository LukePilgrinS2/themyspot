@extends('admin.master')

<style>
  #job_head{
  color:rgb(6, 99, 52); font-weight:bold;
  }
</style>

@section('content')


<div class="content">
    
<script src="https://kit.fontawesome.com/f214784ec5.js" crossorigin="anonymous"></script>

         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-10" style="margin-right: 500px; margin-left: 100px;">
                     <div class="card">
                         <div class="header">
                             <h4 class="title">Adicionar nova vaga</h4>
                             <p class="category">Preencha o Formulário</p>
                         </div>
                         <div class="content">

                            
                         <div class="Form-group">

                        {{Form::open(['url' => 'admin/enviarVaga'])}}
                            
                        <h4 id="job_head">Nome da Vaga</h4>
                            {{Form::text('titulo_vaga')}}
                          </div>

                        
                        <h4 id="job_head">Habilidades</h4>
                          <div class="row">
                            <?php // use proper css styling ?>

                          <li style="margin:15px; float:left; list-style:none" >
                            {{Form::label('HTML')}}
                          {{Form::checkbox('skills[]', 'HTML')}}
                          </li>
                          <li style="margin:15px; float:left; list-style:none">
                          {{Form::label('CSS')}}
                          {{Form::checkbox('skills[]', 'CSS')}}
                          </li>
                          <li style="margin:15px; float:left; list-style:none">
                          {{Form::label('PHP')}}
                          {{Form::checkbox('skills[]', 'PHP')}}
                          </li>
                          <li style="margin:15px; float:left; list-style:none">
                          {{Form::label('JavaScript')}}
                          {{Form::checkbox('skills[]', 'JavaScript')}}
                          </li>
                          <li style="margin:15px; float:left; list-style:none">
                          {{Form::label('Python')}}
                          {{Form::checkbox('skills[]', 'Python')}}
                          </li>
                          <li style="margin:15px; float:left; list-style:none">
                          {{Form::label('Java')}}
                          {{Form::checkbox('skills[]', 'Java')}}
                          </li>
                          <li style="margin:15px; float:left; list-style:none">
                          {{Form::label('C#')}}
                          {{Form::checkbox('skills[]', 'C#')}} 
                          </li>
                          <li style="margin:15px; float:left; list-style:none">
                          {{Form::label('C++')}}
                          {{Form::checkbox('skills[]', 'C++')}}
                          </li>
                          <li style="margin:15px; float:left; list-style:none">
                          {{Form::label('Outra Linguagem')}}
                          {{Form::checkbox('skills[]', 'Outra Linguagem')}}
                          </li>
                          </div>
                          

                            <h4 id="job_head">Requisitos</h4>
                          <div class="form-group">
                            {{Form::textarea('requisitos')}}
                         </div>

                            <h4 id="job_head">Nome da Empresa Contratante</h4>
                           {{Form::text('nome_empresa')}}

                           <h4 id="job_head">Nível de Presença</h4>
                          <div class="row">

                          <li style="margin:15px; float:left; list-style:none" >
                            {{Form::label('Online')}}
                          {{Form::radio('presença[]', 'Online')}}
                          </li>

                          <li style="margin:15px; float:left; list-style:none" >
                            {{Form::label('Semi-presencial')}}
                          {{Form::radio('presença[]', 'Semi-presencial')}}
                          </li>

                          <li style="margin:15px; float:left; list-style:none" >
                            {{Form::label('Presencial')}}
                          {{Form::radio('presença[]', 'Presencial')}}
                          </li>
                          </div>

                          <h4 id="job_head">Número de Vagas Disponíveis </h4>
                            {{Form::number('num_vagas') }}<br>

                            <h4 id="job_head">E-mail ou telefone do Contratante</h4>
                            {{Form::text('contato_info') }}<br>

                            <h4 id="job_head">Data da publicação</h4>
                            {{Form::date('created_at')}}<br>

                            </br></br>{{Form::submit('Adicionar Vaga')}}
                        {{Form::close( )}}

                            </div>    
                             <div class="footer">
                                 <div class="legend">

                                 </div>
                                 <hr>
                                 <div class="stats">

                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

                
                 </div>
             </div>



         </div>
     </div>
     @endsection

