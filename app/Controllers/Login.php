<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
    public function index($pesan = null)
    {
        $data["pesan"] = $pesan;
        return view('login/v_login', $data);
    }

    public function cek()
    {
        //    print_r($_POST);

        $username = $this->request->getPost('email-username');
        $pass = $this->request->getPost('password');

        $user = new LoginModel();
        $dataUser = $user->find($username);
        if ($dataUser == NULL) {
            $data["pesan"] = "Username tidak ditemukan";
            return view('login/v_login', $data);
        } else {
            //set session
            if ($pass == $dataUser -> password) {
                $session = session();
                $session_data = [
                    'username' => $dataUser->username, 
                    "role" => $dataUser->role
                ];

                $session->set($session_data);
                // redirect home
                return redirect()->to(base_url("biodata"));
            } else {
                $data["pesan"] = "Password Salah";
                return view('login/v_login', $data);
            }
        }
    }

    public function register()
    {
        $data = [];
    
        if ($this->request->getMethod() === 'post') {
            $userModel = new LoginModel();
    
            $userData = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'nama' => $this->request->getPost('nama'),
                'role' => $this->request->getPost('role')
            ];
            $userModel->insert($userData);
            return redirect()->to(base_url("login"));
            
        }
    
        return view('login/v_register', $data);
    }
    

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url("login"));
    }
}
