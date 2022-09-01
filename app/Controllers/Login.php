<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        helper('routes');
        $data = [
            'judul' => 'Login'
        ];

        return view('login', $data);
    }


    public function auth()
    {
        helper('routes');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        if ($username == "" || $password == "") {
            session()->setFlashdata('gagal', "Gagal!. Username dan password harus diisi!");
            return redirect()->to(base_url('login'));
        }

        $user = \App\Models\Users::class;
        $user = new $user;

        // cek password sekarang
        $q = $user->where('username', $username)->first();
        if (!$q) {
            session()->setFlashdata('gagal', "Gagal!. Username tidak ditemukan!");
            return redirect()->to(base_url('login'));
        } else {
            if (!password_verify($password, $q['password'])) {
                session()->setFlashdata('gagal', "Gagal!. Password salah!");
                return redirect()->to(base_url('login'));
            } else {
                session()->set([
                    'id' => $q['id'],
                    'username' => $q['username'],
                    'nama' => $q['nama'],
                    'role_id' => $q['role_id']
                ]);

                return redirect()->to(base_url("dashboard"));
            }
        }
    }


    public function logout()
    {
        helper('routes');
        session()->remove('id');
        session()->remove('username');
        session()->remove('nama');
        session()->remove('role_id');

        return redirect()->to(base_url("login"));
    }
}
