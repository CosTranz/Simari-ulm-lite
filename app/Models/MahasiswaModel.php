<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    public function getAllData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_mahasiswa');
        return $builder->get()->getResult();
    }

    public function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_mahasiswa');
        return $builder->insert($data);
    }
    public function getDataById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_mahasiswa');
        $builder->where('nim', $id);
        return $builder->get()->getRow();
    }
    public function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_mahasiswa');
        $builder->where('nim', $id);
        return $builder->update($data);
    }
    public function deleteData($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_mahasiswa');
        $builder->where('nim', $id);
        return $builder->delete();
    }

    
    
}
