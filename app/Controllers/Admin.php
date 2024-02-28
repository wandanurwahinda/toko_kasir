<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;

class Admin extends BaseController
{
    public function __construct()
    {
        $this-> ModelAdmin= new ModelAdmin();
    }

    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'v_admin',
            'grafik' => $this->ModelAdmin->Grafik(),
        ];
        return view('v_template', $data);
    }
    
    public function Setting()
    {
        $data = [
            'judul' => 'Setting',
            'subjudul' => 'Setting',
            'menu' => 'setting',
            'submenu' => '',
            'page' => 'v_setting',
            'setting' => $this->ModelAdmin->DetailData(),
        ];
        return view('v_template', $data);
    }

    public function UpdateSetting()
    {
       $data = [
        'id' => '1',
        'nama_toko' => $this->request->getPost('nama_toko'),
        'slogan' => $this->request->getPost('slogan'),
        'alamat' => $this->request->getPost('alamat'),
        'no_telpon' => $this->request->getPost('no_telpon'),
        'deskripsi' => $this->request->getPost('deskripsi')
       ];
        $this->ModelAdmin->UpdateData($data);
        session()->setFlashdata('pesan','Data Berhasil Diupdate !!');
        return redirect()->to(('Admin/Setting'));
    }
}