<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $fillable = ['cidade', 'estado', 'info', 'user_id'];

    public function user() {
         
        return $this->belongsTo('App\User');
    }
}
