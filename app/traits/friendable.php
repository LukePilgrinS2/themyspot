<?php

namespace App\Traits;
use App\friendships;

trait Friendable {

    public function test() {
        return 'Olá mundo';
    }

    public function adicionarAmigo($id) {

        $Friendship = friendships::create([

            'requester' => $this->id,
            'user_requested' => $id,
        ]);

        if($Friendship) {

            return $Friendship;
        }

        echo 'failed';
    }
}
