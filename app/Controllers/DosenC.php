<?php

namespace App\Controllers;

use App\Models\DosenModel;


class DosenC extends BaseController
{

    public function index()
    {
        helper('form');
        $model = new DosenModel();
        $data = [
            'title' => 'Dosen',
            'content' => 'v_dosen.php',
            'getData' => $model->getAllData()
        ];

        return view('layout/template', $data);
    }

    public function add()
    {
        helper('form');
        $data = [
            'title' => 'Dosen',
            'content' => 'v_dosen_add'
        ];
        return view('layout/template', $data);
    }

    public function submit()
    {
    
        $id = $this->request->getPost('id');
        $model = new DosenModel();

        $data = array(
            'nip' => $this->request->getPost('nip'), 
            'nama_dosen' => $this->request->getPost('nama_dosen')
        );
    
        if ($id == "") {
            // Operasi INSERT
            $result = $model->insertData($data);
        } else {
            // Operasi UPDATE
            $result = $model->updateData($id, $data);
        }
        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to('dosenc/index');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal disimpan.');
            return redirect()->to('dosenc/add');
        }
    }
    
    // public function edit($id)
    // {
    //     helper('form');
    //     $model = new DosenModel();
    //     $data = [
    //         'title' => 'Edit',
    //         'content' => 'v_dosen_edit',
    //         'getData' => $model->getDataById($id)
    //     ];
    
    //     return view('layout/template', $data);
    // }
    

    public function edit()
{
    $id = $this->request->uri->getSegment(3);
    $model = new DosenModel();
    $get = $model->getDataById($id);

    $data['id'] = $id;
        $data['nip'] = $id;
        $data['nama_dosen'] = $get->nama_dosen;
       
    return $this->response->setJSON($data);
}

    public function update()
    {
        helper("form");
        $nip = $this->request->getPost('nip'); 
        $nama_dosen = $this->request->getPost('nama_dosen'); 
    
        $data = array(
            'nip' => $nip,
            'nama_dosen' => $nama_dosen 
        );
    
        $model = new DosenModel();
        $result = $model->updateData($nip, $data);
    
        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil diperbarui.');
            return redirect()->to('dosenc/index');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal diperbarui.');
            return redirect()->to('dosenc/edit/' . $nip);
        }
    }

    public function delete($id)
    {
        $model = new DosenModel();
        $result = $model->deleteData($id);
        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil dihapus.');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal dihapus.');
        }
    
        return redirect()->to('dosenc/index');
    }
    
}
