<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\APIController;

class HomeController extends APIController
{
    public function home()
    {
        $data = [
            'page' => "This is the home page"
        ];

        $message = "You found me!";

        return $this->sendResponse($data, $message);
    }

    public function redis()
    {
        // $data = Redis::get('app_name');
        // $data = Redis::set('app_name', 'IT PROJ');

        // $data = Redis::hMSet('user:1', ['username' => 'joshuaetim', 'password' => 'password']);

        // return $data;
        $data = Redis::hGetAll('user:1');

        return $this->sendResponse(['name' => $data], "successful");
    }
}
