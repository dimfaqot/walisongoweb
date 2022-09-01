<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {

        return view('welcome_message');
    }

    public function tes()
    {
        echo json_encode(['status' => 'Ok']);
    }
}
