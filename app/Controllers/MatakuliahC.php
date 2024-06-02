<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;


class MatakuliahC extends BaseController
{

    public function index()
    {
        helper('form');
        $model = new MatakuliahModel();
        $data = [
            'title' => 'Matakuliah',
            'content' => 'v_matakuliah.php',
            'getData' => $model->getAllData()
        ];

        return view('layout/template', $data);
    }

    public function add()
    {
        helper('form');
        $data = [
            'title' => 'Matakuliah',
            'content' => 'v_matakuliah_add'
        ];
        return view('layout/template', $data);
    }

    public function submit()
    {

        $id = $this->request->getPost('id');
        $model = new MatakuliahModel();
        $data = array(
            'kode_mk' => $this->request->getPost('kode_mk'),
            'nama_mk' => $this->request->getPost('nama_mk'),
            'sks' => $this->request->getPost('sks'),
            'semester' => $this->request->getPost('semester')
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
            return redirect()->to('matakuliahc/index');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal disimpan.');
            return redirect()->to('matakuliahc/add');
        }
    }

    // public function edit($id)
    // {
    //     helper('form');
    //     $model = new MatakuliahModel();
    //     $data = [
    //         'title' => 'Edit',
    //         'content' => 'v_matakuliah_edit',
    //         'getData' => $model->getDataById($id)
    //     ];

    //     return view('layout/template', $data);
    // }

    public function edit()
    {
        $id = $this->request->uri->getSegment(3);
        $model = new MatakuliahModel();
        $get = $model->getDataById($id);

        $data['id'] = $id;
        $data['kode_mk'] = $id;
        $data['nama_mk'] = $get->nama_mk;
        $data['sks'] = $get->sks;
        $data['semester'] = $get->semester;

        return $this->response->setJSON($data);
    }

    public function update()
    {
        helper("form");
        $kode_mk = $this->request->getPost('kode_mk');
        $nama_mk = $this->request->getPost('nama_mk');
        $sks = $this->request->getPost('sks');
        $semester = $this->request->getPost('semester');

        $data = array(
            'kode_mk' => $kode_mk,
            'nama_mk' => $nama_mk,
            'sks' => $sks,
            'semester' => $semester
        );

        $model = new MatakuliahModel();
        $result = $model->updateData($kode_mk, $data);

        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil diperbarui.');
            return redirect()->to('matakuliahc/index');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal diperbarui.');
            return redirect()->to('matakuliahc/edit/' . $kode_mk);
        }
    }

    public function delete($id)
    {
        $model = new MatakuliahModel();
        $result = $model->deleteData($id);
        if ($result) {
            // Pesan keberhasilan
            session()->setFlashdata('success', 'Data berhasil dihapus.');
        } else {
            // Pesan kesalahan
            session()->setFlashdata('error', 'Data gagal dihapus.');
        }

        return redirect()->to('matakuliahc/index');
    }
}
