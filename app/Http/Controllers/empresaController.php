<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class empresaController extends Controller
{
    public function index() {

        return view('empresa.index');
    }
}
 