<?php

namespace App\Models;

use CodeIgniter\Model;

class PerkuliahanModel extends Model
{
    protected $table = 'tb_perkuliahan';
    protected $primaryKey = 'id_perkuliahan';
    protected $allowedFields = ['nim', 'kode_mk', 'nip', 'ruangan'];

    public function getPerkuliahanWithRelations()
    {
        return $this
            ->select('tb_perkuliahan.*, tb_mahasiswa.nama_mhs, tb_matakuliah.nama_mk, tb_dosen.nama_dosen')
            ->join('tb_mahasiswa', 'tb_mahasiswa.nim = tb_perkuliahan.nim')
            ->join('tb_matakuliah', 'tb_matakuliah.kode_mk = tb_perkuliahan.kode_mk')
            ->join('tb_dosen', 'tb_dosen.nip = tb_perkuliahan.nip')
            ->findAll();
    }
    
    public function getMahasiswaData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_mahasiswa');
        return $builder->get()->getResult();
    }

    public function getMatakuliahData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_matakuliah');
        return $builder->get()->getResult();
    }

    public function getDosenData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_dosen');
        return $builder->get()->getResult();
    }

    public function insertData($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_perkuliahan');
        return $builder->insert($data);
    }
    public function deletePerkuliahan($id_perkuliahan)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_perkuliahan');
        $builder->where('id_perkuliahan', $id_perkuliahan);
        return $builder->delete();
    }
    
}