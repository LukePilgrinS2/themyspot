<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\notifications; 

use App\friendships;
use App\user;

class ProfileController extends Controller
{
    public function index($slug) {

        $userInfo = DB::table('users')
        ->leftJoin('profiles', 'profiles.user_id', 'users.id')
        ->where('slug', $slug)
        ->get();

        return view('profile.index', compact('userInfo'))->with('data', Auth::user()->profile);
    }

    public function uploadImg(Request $request) {

        $file = $request->file('pic');

        $filename = $file->getClientOriginalName();

        $path = 'public/img';

        $file->move($path, $filename);
        $user_id = Auth::user()->id;

        DB::table('users')->where('id', $user_id)->update(['pic' => $filename]);
        return back();
    }

    public function editarFormPerfil() {
        return view('profile.editarPerfil')->with('data', Auth::user()->profile);
    }

    public function updatePerfil(Request $request) {
        
        $user_id = Auth::user()->id;

        DB::table('profiles')->where('user_id', $user_id)->update($request->except('_token'));
        return back();
}

public function encontrarAmigos() {

    $uid = Auth::user()->id;
    $allUsers = DB::table('profiles')->leftJoin('users', 'users.id', '=', 'profiles.user_id')->where('users.id', '!=', $uid)->get();

    return view('profile.encontrarAmigos', compact('allUsers'));
}

public function enviarPedido($id) {
    
    Auth::user()->adicionarAmigo($id);

    return back();
}

public function requests() {

    $uid = Auth::user()->id;

    $FriendRequests = DB::table('friendships')
              ->rightJoin('users', 'users.id', '=', 'friendships.requester')
              ->orwhere('status', 0)
              ->where('friendships.user_requested', '=', $uid)->get();
    $FriendRequests_2 = DB::table('friendships')
              ->rightJoin('users', 'users.id', '=', 'friendships.user_requested')
              ->orwhere('status', 0)
              ->where('friendships.requester', '=', $uid)->get();

        return view('profile.requests', compact('FriendRequests'));      
}

public function aceitar($name, $id) {

    $uid = Auth::user()->id;
    $checkRequest = friendships::where('requester', $id)
             ->where('user_requested', $uid)
             ->first();
    if($checkRequest) {
        //echo "Yes";

     $updateFriendship = DB::table('friendships')
        ->where('user_requested', $uid)
        ->where('requester', $id)
        ->update(['status' => 1]);



        $notifications = new notifications;
        $notifications->note = 'aceitou seu pedido de amizade'; 
        $notifications->user_hero = $id; // quem está aceitando meu pedido
        $notifications->user_logged = Auth::user()->id; // eu
        $notifications->status = '1'; // notificações não lidas
        $notifications->save();

        if($notifications) {

            return back()->with('msg', 'Você e '. $name. ' agora são amigos');   
        }
     } else {
        
        return back()->with('msg', 'Vocês agora são amigos');   
    }
}

    public function amigos() {
       $uid = Auth::user()->id;

       $amigo1 = DB::table('friendships')
             ->leftJoin('users', 'users.id', 'friendships.user_requested')
             ->where('status', 1)
             ->where('requester', $uid)
             ->get();

    $amigo2 = DB::table('friendships')
            ->leftJoin('users', 'users.id', 'friendships.requester')
            ->where('status', 1)
            ->where('user_requested', $uid)
            ->get();
     
    $amigos = array_merge($amigo1->toArray(), $amigo2->toArray());

    return view('profile.amigos', compact('amigos'));   

}

    public function removerPedido($id) {

        DB::table('friendships')
            ->where('user_requested', Auth::user()->id)
            ->where('requester', $id)
            ->delete();

        return back()->with('msg', 'O pedido foi removido');
    }

    public function notifications($id) {

        $uid = Auth::user()->id;
        $notes = DB::table('notifications')
            ->leftJoin('users', 'users.id', 'notifications.user_logged')
            ->where('notifications.id', $id)
            ->where('user_hero', $uid)
            ->orderBy('notifications.created_at', 'desc')
            ->get();

            $updateNoti = DB::table('notifications')
            ->where('notifications.id', $id)
            ->update(['status' => 0]);

            return view('profile.notificaçoes', compact('notes'));  
    }

    public function vagas() {

        $vagas = DB::table('vagas')->get();

        return view('profile.vagas', compact('vagas'));
    }

    public function vaga($id) {

        $vagas = DB::table('vagas')->where('id', $id)
        ->get();

        return view('profile.vaga', compact('vagas'));
    }

    public function enviarMsg(Request $request) {

        $conID = $request->conID;
        $msg = $request->msg;

        $fetch_userTo = DB::table('mensagens')->where('id_conversa', $conID)
        ->where('user_to', '!=', Auth::user()->id)
        ->get();

        $userTo = $fetch_userTo[0]->user_to;

        $sendM = DB::table('mensagens')->insert([

            'user_to' => $userTo,
            'user_from' => Auth::user()->id,
            'msg' => $msg,
            'status' => 1,
            'id_conversa' => $conID
        ]);

        if($sendM) {

            $userMsg = DB::table('mensagens')->join('users', 'users.id', 'mensagens.user_from')
            ->where('mensagens.id_conversa', $conID)->get();
            return $userMsg;
        }

    }

    public function novasMensagens(){

        $uid = Auth::user()->id;
  
        $amigo1 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.user_requested') 
                ->where('status', 1)
                ->where('requester', $uid) 
                ->get();
  
        $amigo2 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.requester')
                ->where('status', 1)
                ->where('user_requested', $uid)
                ->get();
  
        $amigos = array_merge($amigo1->toArray(), $amigo2->toArray());
        
        return view('novasMensagens', compact('amigos', $amigos));
      }

      public function enviarNovaMsg(Request $request){
        $msg = $request->msg;
        $friend_id = $request->friend_id;
        $myID = Auth::user()->id;

        //check if conversation already started or not
        $checkCon1 = DB::table('conversas')->where('usuario_um',$myID)
        ->where('usuario_dois',$friend_id)->get(); // if loggedin user started conversation

        $checkCon2 = DB::table('conversas')->where('usuario_dois',$myID)
        ->where('usuario_um',$friend_id)->get(); // if loggedin recviced message first

        $allCons = array_merge($checkCon1->toArray(),$checkCon2->toArray());

        if(count($allCons)!=0){
          // old conversation
          $conID_old = $allCons[0]->id;
          //insert data into messages table
          $MsgSent = DB::table('mensagens')->insert([
            'user_from' => $myID,
            'user_to' => $friend_id,
            'msg' => $msg,
            'id_conversa' =>  $conID_old,
            'status' => 1
          ]);
        }else {
          // new conversation
          $conID_new = DB::table('conversas')->insertGetId([
            'usuario_um' => $myID,
            'usuario_dois' => $friend_id
          ]);
          echo $conID_new;

          $MsgSent = DB::table('mensagens')->insert([
            'user_from' => $myID,
            'user_to' => $friend_id,
            'msg' => $msg,
            'id_conversa' =>  $conID_new,
            'status' => 1
          ]);

        }
    }
}