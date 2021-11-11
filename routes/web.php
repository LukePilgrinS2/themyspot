<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/mensagens', function() {
    return view('mensagens');
});

Route::get('/getMensagens', function() {
   

    $uid = Auth::user()->id;

       $amigo1 = DB::table('friendships')
             ->join('users', 'users.id', 'friendships.user_requested' )
             ->leftJoin('conversas', 'conversas.usuario_um', 'friendships.user_requested')
             ->where('status', 1)
             ->where('requester', Auth::user()->id)
             ->where('usuario_dois', Auth::user()->id)
             ->get();

        $amigo2 = DB::table('friendships')
             ->join('users', 'users.id', 'friendships.requester' )
             ->leftJoin('conversas', 'conversas.usuario_um', 'friendships.requester')
             ->where('status', 1)
             ->where('user_requested', Auth::user()->id)
             ->where('usuario_dois', Auth::user()->id)
             ->get(); 

        $amigo3 = DB::table('friendships')
             ->join('users', 'users.id', 'friendships.user_requested' )
             ->leftJoin('conversas', 'conversas.usuario_dois', 'friendships.user_requested')
             ->where('status', 1)
             ->where('requester', Auth::user()->id)
             ->where('usuario_um', Auth::user()->id)
             ->get();    

        $amigo4 = DB::table('friendships')
             ->join('users', 'users.id', 'friendships.requester' )
             ->leftJoin('conversas', 'conversas.usuario_dois', 'friendships.requester')
             ->where('status', 1)
             ->where('user_requested', Auth::user()->id)
             ->where('usuario_um', Auth::user()->id)
             ->get();         

  

    return array_merge($amigo1->toArray(), $amigo2->toArray(), $amigo3->toArray(), $amigo4->toArray());
});

Route::get('/getMensagens/{id}', function($id) {
    

    $userMsg = DB::table('mensagens')->join('users', 'users.id', 'mensagens.user_from')
    ->where('mensagens.id_conversa', $id)->get();
    return $userMsg;
});

Route::post('/enviarMsg', 'ProfileController@enviarMsg');

Route::post('/enviarNovaMsg', 'ProfileController@enviarNovaMsg');

Route::get('/novasMensagens', 'ProfileController@novasMensagens');

Route::get('/', function () {

    $posts = DB::table('posts')
    ->leftJoin('profiles', 'profiles.user_id', 'posts.user_id')
    ->leftJoin('users', 'users.id', 'posts.user_id')
    ->orderBy('posts.created_at', 'desc')->take(2)
    ->get();

    return view('Welcome', compact('posts'));
});

Route::get('/posts', function () {

    $posts_json = DB::table('posts')
    ->leftJoin('profiles', 'profiles.user_id', 'posts.user_id')
    ->leftJoin('users', 'posts.user_id', 'users.id')
    ->orderBy('posts.created_at', 'desc')->take(10)
    ->get();

    return $posts_json;
});

Route::post('addPost', 'PostController@addPost');

Auth::routes();



Route::group(['middleware' => 'auth'], function() {

    Route::get('/home', 'HomeController@index');

    Route::get('/profile', 'HomeController@index');

    Route::get('/profile/{slug}', 'ProfileController@index');

    Route::get('/mudarImg',function() {

        return view('profile.pic');
    });

    Route::post('/uploadImg', 'ProfileController@uploadImg');

    Route::get('editarPerfil', 'ProfileController@editarFormPerfil');

    Route::post('/updatePerfil', 'ProfileController@updatePerfil');

    Route::get('/encontrarAmigos', 'ProfileController@encontrarAmigos');

    Route::get('/adicionarAmigo/{id}', 'ProfileController@enviarPedido');

    Route::get('/requests', 'ProfileCOntroller@requests');

    Route::get('/aceitar/{name}/{id}', 'ProfileController@aceitar');

    Route::get('amigos', 'ProfileController@amigos');

    Route::get('removerPedido/{id}', 'ProfileController@removerPedido');

    Route::get('/notifications/{id}', 'ProfileController@notifications');

    Route::get('/unfriend/{id}', function($id) {

        echo $loggedUser = Auth::user()->id;
        
        DB::table('friendships')
        ->where('requester', $loggedUser)
        ->where('user_requested', $id)
        ->delete();
        DB::table('friendships')
        ->where('user_requested', $loggedUser)
        ->where('requester', $id)
        ->delete();
        return back()->with('msg', 'Sua amizade com esta pessoa acabou');
    });

    Route::get('/excluirVaga/{id}', function($id) {

         $loggedUser = Auth::user()->id;
        
        DB::table('vagas')
        ->where('user_id', $loggedUser)
        ->where('id', $id)
        ->delete();
        return back();
    });
});

Route::get('vagas', 'ProfileController@vagas');

Route::get('vaga/{id}', 'ProfileController@vaga');



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {

    Route::get('/', 'AdminController@index');

   Route::get('/addVagas', function() {

    return view('admin.addVaga');
   });

   Route::get('/vagas','AdminController@viewVagas');

   Route::post('enviarVaga', 'AdminController@enviarVaga');
});


Route::group(['prefix' => 'empresa', 'middleware' => ['auth', 'empresa']], function() {

    Route::get('/', 'empresaController@index');
});

Route::get('/logout', 'Auth\LoginController@logout');

