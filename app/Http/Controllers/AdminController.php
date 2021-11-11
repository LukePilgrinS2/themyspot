<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {

        return view('admin.index');
    }

    public function enviarVaga(Request $r) { 

        if($r->skills == null) {return back();} else {
        $skills = implode($r->skills, ','); }

        if($r->presença == null) {return back();} else {
            $presença = implode($r->presença, ','); }
        
        if($r->contato_info == null) {return back();} else {
        $info_contato = $r->contato_info; }

        if($r->titulo_vaga == null) {return back();} else {
        $titulo_vaga = $r->titulo_vaga; }
        
        if($r->requisitos == null) {return back();} else {
        $requisitos = $r->requisitos; }

        if($r->num_vagas == null) {return back();} else {
            $num_vagas = $r->num_vagas; }
       
        $user_id = Auth::user()->id; 

        $name_user = Auth::user()->name;

        $email_user = Auth::user()->email;

        $pic_user = Auth::user()->pic;
   
        if($r->nome_empresa == null) {return back();} else {
        $nome_empresa = $r->nome_empresa;  }
      
        if($r->created_at == null) {return back();} else {
        $created_at = $r->created_at;  }

        $add_vaga = DB::table('vagas')->insert([
            'skills' => $skills,
            'presença' => $presença,
            'info_contato' => $info_contato,
            'titulo_vaga' => $titulo_vaga,
            'name_user' => $name_user,
            'email_user' => $email_user,
            'pic_user' => $pic_user,
            'requisitos' => $requisitos,
            'num_vagas' => $num_vagas,
             'user_id' => $user_id,
             'nome_empresa' => $nome_empresa,
             'created_at' => $created_at,

        ]); 

        if($add_vaga) {
            
            $vagas = DB::table('vagas')->where('user_id', Auth::user()->id)->get();
       
            return view('admin.vagas', compact('vagas'));
        } 
    }

    public function viewVagas() {

       $vagas = DB::table('vagas')->where('user_id', Auth::user()->id)->get();
       
        return view('admin.vagas', compact('vagas'));
    }
}
 