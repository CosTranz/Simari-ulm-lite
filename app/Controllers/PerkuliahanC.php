<?php

namespace App\Controllers;

use App\Models\PerkuliahanModel;

class PerkuliahanC extends BaseController
{

    public function index()
    {
        helper('form');
        $model = new PerkuliahanModel();

        // Memanggil metode untuk mengambil data dengan relasi
        $data['getData'] = $model->getPerkuliahanWithRelations();

        $data = [
            'title' => 'Perkuliahan',
            'content' => 'v_perkuliahan.php',
            'getData' => $data['getData']
        ];

        return view('layout/template', $data);
    }

    // ... Metode lainnya, termasuk metode untuk menambah data perkuliahan ...

    // Metode untuk menambah data perkuliahan
    public function add()
    {
        $model = new PerkuliahanModel();
        $data = [
            'title' => 'Perkuliahan',
            'content' => 'v_perkuliahan_add'
        ];

        $data['mahasiswa'] = $model->getMahasiswaData();
        $data['matakuliah'] = $model->getMatakuliahData();
        $data['dosen'] = $model->getDosenData();
    
        if ($this->request->getMethod() === 'post') {
            // Ambil data dari formulir
            $dataPerkuliahan = [
                'nim' => $this->request->getPost('nim'),
                'kode_mk' => $this->request->getPost('kode_mk'),
                'nip' => $this->request->getPost('nip'),
                'ruangan' => $this->request->getPost('ruangan')
            ];
    
            // Simpan data ke database
            $result = $model->insertData($dataPerkuliahan);
            if ($result) {
                // Pesan keberhasilan
                session()->setFlashdata('success', 'Data berhasil disimpan.');
                return redirect()->to('perkuliahanc/index');
            } else {
                // Pesan kesalahan
                session()->setFlashdata('error', 'Data gagal disimpan.');
                return redirect()->to('perkuliahanc/add');
            }
        }

        return view('layout/template', $data);
        // Mengambil data mahasiswa, matakuliah, dan dosen
       
    
    }
    
    
    public function hapus($id_perkuliahan)
    {
        $model = new PerkuliahanModel();
        $result = $model->deletePerkuliahan($id_perkuliahan);
        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil dihapus.');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal dihapus.');
        }
    
        return redirect()->to('perkuliahanc/index');
    }
}
