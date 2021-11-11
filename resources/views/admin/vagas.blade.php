@extends('admin.master')
@section('content')
<style>
    table{width:100%}

    table th{padding:10px; border:1px solid #ddd}
    table td{ padding:10px; border-bottom:1px solid #ddd}
    </style> 
<div class="content">
    
<script src="https://kit.fontawesome.com/f214784ec5.js" crossorigin="anonymous"></script>

         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12" style="margin-right: 500px; margin-left: 10px;">
                     <div class="card">
                         <div class="header">
                             <h4 class="title">Vagas adicionadas por você</h4><br>
             
                         </div>
                         <div class="content"><table>

                        <tr>
                                <th>
                                    Nome da vaga
                            </th>    
                            <th>
                                    Habilidades
                            </th> 
                            <th>
                                    Nome da empresa
                            </th> 
                            <th>
                                    Presença
                            </th> 
                            <th>
                                    Num. Vagas
                            </th>
                            <th>
                                    Informações de contato
                            </th> 
                            <th>
                                    Data de publicação 
                            </th> 
                        </tr> 
                            @foreach($vagas as $vaga)

                            <tr>
                            <td>{{$vaga->titulo_vaga }}  </td>
                            <td>{{$vaga->skills}}</td>
                                <td>{{$vaga->nome_empresa}}</td>
                                <td>{{$vaga->presença}}</td>
                                <td>{{$vaga->num_vagas}}</td>
                                <td>{{$vaga->info_contato}}</td>
                                <td>{{$vaga->created_at}}</td>
                                <td><a href="{{url('/excluirVaga')}}/{{$vaga->id}}">Excluir</a></td>
                            </tr>
                            @endforeach
                        </table> 

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
     @endsection

