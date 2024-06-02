<?php

namespace App\Models;

use CodeIgniter\Model;

class MatakuliahModel extends Model
{
    public function getAllData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_matakuliah');
        return $builder->get()->getResult();
    }

    public function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_matakuliah');
        return $builder->insert($data);
    }
    public function getDataById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_matakuliah');
        $builder->where('kode_mk', $id);
        return $builder->get()->getRow();
    }
    public function updateData($id, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_matakuliah');
        $builder->where('kode_mk', $id);
        return $builder->update($data);
    }
    public function deleteData($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_matakuliah');
        $builder->where('kode_mk', $id);
        return $builder->delete();
    }
}
