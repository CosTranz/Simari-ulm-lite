<?php

namespace App\Controllers;

class Biodata extends BaseController
{
   public function index(){
    $session = session();

    if($session->get('role')==null){
        return redirect()-> to(base_url("login"));
    }

    $data = [
        'title' => 'Home',
        'content' => 'v_biodata',
    ];

    return view('layout/template', $data);
   }
}
