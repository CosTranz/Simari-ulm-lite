<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'tb_login';
    protected $primaryKey = 'username';
    protected $returnType = 'object';
    protected $allowedFields = [
        'username', 'password', 'nama', 'role'
    ];

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function getUserById($id)
    {
        return $this->find($id);
    }

    public function userExists($username)
    {
        return $this->where('username', $username)->countAllResults() > 0;
    }
}
