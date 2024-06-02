<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
        $session = session();
    
        if($session->get('role')==null){
            return redirect()-> to(base_url("login"));
        }
    
        $data = [
            'title' => 'Home',
            'content' => 'v_mahasiswa',
        ];
    
        return view('layout/template1', $data);
       }
}
