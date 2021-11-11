
<!doctype html>
<html lang="{{ app()->getLocale() }}">
@extends('profile.master')

@section('content')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>MySpot</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    

        <style>
            
            html, body {
                background-color: #ddd;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .top_bar{
              position:relative; width:99%; top:0; padding:5px; margin:0 5
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .top-left {
                position: absolute;
                width:40%
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .head_har{
              background-color: #f6f7f9;
                    border-bottom: 1px solid #dddfe2;
                    border-radius: 2px 2px 0 0;
                    font-weight: bold;
                    padding: 8px 6px;
            }
            .left-sidebar, .right-sidebar{
              background-color:#fff;
              height:600px;
            }
            .posts_div{margin-bottom:10px !important;}
            .posts_div h3{
              margin-top:4px !important;
            }
            #postText{
              border:none;
              height:100px
            }
        </style>
        <script src="https://kit.fontawesome.com/f214784ec5.js" crossorigin="anonymous"></script>
    </head>
    <body>
    
        <div class="flex-center position-ref full-height">
      
                
         
<div  class="col-md-12"  id="app">
       
        <div class="col-md-9 center-con" style="margin-right: 500px; margin-left: 150px;">
        @if(Auth::check())    <div class="posts_div">
                <div class = "head_har">
                   
                </div>  
                <div style="background-color:#fff">  
                  <div class="row">
                      <div class="col-md-1 pull-left">
                          <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}"
                          style="width:50px; margin:10px" class="img-rounded">
                      </div>
                      <div class="col-md-11 pull-right">
                    <form method="post" enctype="multipart/form-data" v-on:submit.prevent="addPost">
                    <textarea v-model="content" id="postText" class="form-control"
                    placeholder="No que você está pensando?"></textarea>
                        <button type="submit" class="btn btn-sm btn-info pull-right" 
                        style="margin:10px; padding:5 15 5 15; background-color:#4267b2" id="postBtn">Postar</button>
                  </form>
                  </div> 
        
                  
        </div>

        @endif
        <div class="posts_div">
            <div class="head_har"> </div>
            <div v-for="post in posts">
                <div class="col-md-12" style="background-color:#fff">
                <div class="col-md-2 pull-left">
                    <img :src="'http://localhost/TheMySpot/public/img/' + post.pic"
                    style="width:70px; margin:5px">
                </div> 
                
                <div class="col-md-10">
                    <h3> @{{post.name}}</h3>
                    <p> <i class="fa fa-globe"></i>
                    @{{post.cidade}}  | @{{post.estado}}</p>
                </div>

                <p class="col-md-12" style="color:#333"><b> @{{post.content}}</b></p>
                </div>  

           </div>
           
          </div>
          
         </div>
         
        </div>
        
     </div>

    
        
    
    
       <script src="public/js/app.js"></script>
       

      
    </body>
    @endsection

</html>
