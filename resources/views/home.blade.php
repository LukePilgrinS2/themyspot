@extends('profile.master')

@section('content')
<div class="container">
   
    <div class="row">

    @include('profile.barraLateral')    

        <div class="col-md-9" style="margin-right: 500px; margin-left: 150px;">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Você está logado! <br><br>
                    <h4>Seja Bem-vindo ao MySpot!</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
