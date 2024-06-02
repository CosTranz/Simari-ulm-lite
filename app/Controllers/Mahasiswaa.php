<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;


class Mahasiswaa extends BaseController
{

    public function index()
    {
        helper('form');
        $model = new MahasiswaModel();
        $data = [
            'title' => 'Mahasiswa',
            'content' => 'v_mahasiswa',
            'getData' => $model->getAllData(),
        ];

        return view('layout/template', $data);
    }

    public function submit()
    {
        $id = $this->request->getPost('id');
        $model = new MahasiswaModel();
    
        $data = array(
            'nim' => $this->request->getPost('nim'),
            'nama_mhs' => $this->request->getPost('nama_mhs'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'alamat' => $this->request->getPost('alamat'),
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
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal disimpan.');
        }
    
        return redirect()->to('mahasiswaa/index');
    }
    


    public function add()
    {
        helper('form');
        $data = [
            'title' => 'Mahasiswa',
            'content' => 'v_mahasiswaa_add'
        ];
        return view('template', $data);
    }

   

public function edit()
{
    $id = $this->request->uri->getSegment(3);
    $model = new MahasiswaModel();
    $get = $model->getDataById($id);

    $data['id'] = $id;
        $data['nim'] = $id;
        $data['nama_mhs'] = $get->nama_mhs;
        $data['tgl_lahir'] = $get->tgl_lahir;
        $data['jenis_kelamin'] = $get->jenis_kelamin;
        $data['alamat'] = $get->alamat;
       
    return $this->response->setJSON($data);
}

public function update()
{
    helper("form");
    $nim = $this->request->getPost('nim');
    $nama_mhs = $this->request->getPost('nama_mhs');
    $jenis_kelamin = $this->request->getPost('jenis_kelamin');
    $tgl_lahir = $this->request->getPost('tgl_lahir');
    $alamat = $this->request->getPost('alamat');

    $data = array(
        'nama_mhs' => $nama_mhs,
        'jenis_kelamin' => $jenis_kelamin,
        'tgl_lahir' => $tgl_lahir,
        'alamat' => $alamat,
    );

    $model = new MahasiswaModel();
    $result = $model->updateData($nim, $data);

    if ($result) {
        // Pesan keberhasilan
        session()->setFlashdata('success', 'Data berhasil diperbarui.');
        return redirect()->to('mahasiswaa/index');
    } else {
        // Pesan kesalahan
        session()->setFlashdata('error', 'Data gagal diperbarui.');
        return redirect()->to('mahasiswaa/edit/' . $nim);
    }
}


    public function delete($id)
    {
        $id = $this->request->uri->getSegment(3);
        $model = new MahasiswaModel();
        $result = $model->deleteData($id);

        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil dihapus.');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal dihapus.');
        }

        return redirect()->to('mahasiswaa/index');
    }
}
