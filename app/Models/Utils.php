<?php

namespace App\Models;

use CodeIgniter\Model;

class Utils extends Model
{
    public function cols($tabel)
    {
        $t = firstWordUpCase($tabel);
        if ($tabel !== 'akses' && $tabel !== 'sk') {
            $t = firstWordUpCase($tabel) . 's';
        }
        $module = "App\\Models\\" . $t;
        $model = new $module();
        $res = $model->cols();
        return $res;
    }

    public function tables()
    {

        $db = db_connect();

        $tables = $db->listTables();
        return $tables;
    }
    public function propscol()
    {
        $tables = [
            ['code' => 'l', 'val' => 'Label'],
            ['code' => 'c', 'val' => 'Column'],
            ['code' => 'case', 'val' => 'Case Text'],
            ['code' => 'r', 'val' => 'Required'],
            ['code' => 't', 'val' => 'Type Input'],
            ['code' => 'f', 'val' => 'Format Template'],
            ['code' => 'lc', 'val' => 'Label dan Column'],
            ['code' => 'lcr', 'val' => 'Label, Column dan Required'],
            ['code' => 'lcrcase', 'val' => 'Label, Column, Required, Case/fs'],
            ['code' => 'search', 'val' => 'Query'],
            ['code' => 'searchi', 'val' => 'Select Self'],
            ['code' => 'checkbox', 'val' => 'Checkbox'],
            ['code' => 'checkboxi', 'val' => 'Checkbox Inline'],
            ['code' => 'radio', 'val' => 'Radio'],
            ['code' => 'radioi', 'val' => 'Radio Inline'],
        ];
        return $tables;
    }
    public function fontsize()
    {
        $res = [
            ['label' => 'Small', 'val' => 'smaller'],
            ['label' => 'Medium', 'val' => 'small'],
            ['label' => 'Large', 'val' => 'medium'],
            ['label' => 'X-Large', 'val' => 'Large'],
        ];
        return $res;
    }
    public function kategoriuser()
    {
        $res = ['Santri', 'Karyawan'];
        return $res;
    }
    public function ketuser()
    {
        $users = \App\Models\Users::class;
        $users = new $users;
        $q = $users->select('ket')->groupBy('ket')->orderBy('ket', 'ASC')->find();
        $res = [];
        foreach ($q as $i) {
            $res[] = $i['ket'];
        }
        return $res;
    }
    public function sub()
    {
        $users = \App\Models\Users::class;
        $users = new $users;
        $q = $users->select('sub')->groupBy('sub')->orderBy('sub', 'ASC')->find();
        $res = [];
        foreach ($q as $i) {
            $res[] = $i['sub'];
        }
        return $res;
    }

    public function kelurahan()
    {
        $users = \App\Models\Users::class;
        $users = new $users;
        $q = $users->select('kelurahan')->groupBy('kelurahan')->orderBy('kelurahan', 'ASC')->find();
        $res = [];
        foreach ($q as $i) {
            $res[] = $i['kelurahan'];
        }
        return $res;
    }
    public function kecamatan()
    {
        $users = \App\Models\Users::class;
        $users = new $users;
        $q = $users->select('kecamatan')->groupBy('kecamatan')->orderBy('kecamatan', 'ASC')->find();
        $res = [];
        foreach ($q as $i) {
            $res[] = $i['kecamatan'];
        }
        return $res;
    }
    public function kabupaten()
    {
        $users = \App\Models\Users::class;
        $users = new $users;
        $q = $users->select('kabupaten')->groupBy('kabupaten')->orderBy('kabupaten', 'ASC')->find();
        $res = [];
        foreach ($q as $i) {
            $res[] = $i['kabupaten'];
        }
        return $res;
    }
    public function provinsi()
    {
        $users = \App\Models\Users::class;
        $users = new $users;
        $q = $users->select('provinsi')->groupBy('provinsi')->orderBy('provinsi', 'ASC')->find();
        $res = [];
        foreach ($q as $i) {
            $res[] = $i['provinsi'];
        }
        return $res;
    }
    public function ukurankertas()
    {
        $res = ['Legal', 'A4', 'F4', 'A3', 'Letter'];
        return $res;
    }

    public function orientasi()
    {
        $res = ['P', 'L'];
        return $res;
    }

    public function filters()
    {
        // mencari menu berdasarkan akses
        $db = \App\Models\Menus::class;
        $db = new $db;

        $q = $db->findAll();
        $val = [];
        foreach ($q as $i) {
            for ($k = 0; $k < 2; $k++) {
                if ($k == 0) {
                    $val[] = str_replace(" ", "", strtolower($i['menu']));
                } else {
                    $val[] = str_replace(" ", "", strtolower($i['menu'])) . '/*';
                }
            }
        }

        return $val;
    }
    public function bulan()
    {
        $val = [
            ['bulan' => 'Januari', 'angka' => "01", 'singkatan' => 'Jan'],
            ['bulan' => 'Februari', 'angka' => "02", 'singkatan' => 'Feb'],
            ['bulan' => 'Maret', 'angka' => "03", 'singkatan' => 'Mar'],
            ['bulan' => 'April', 'angka' => "04", 'singkatan' => 'Apr'],
            ['bulan' => 'Mei', 'angka' => "05", 'singkatan' => 'Mei'],
            ['bulan' => 'Juni', 'angka' => "06", 'singkatan' => 'Jun'],
            ['bulan' => 'Juli', 'angka' => "07", 'singkatan' => 'Jul'],
            ['bulan' => 'Agustus', 'angka' => "08", 'singkatan' => 'Agu'],
            ['bulan' => 'September', 'angka' => "09", 'singkatan' => 'Sep'],
            ['bulan' => 'Oktober', 'angka' => "10", 'singkatan' => 'Okt'],
            ['bulan' => 'November', 'angka' => "11", 'singkatan' => 'Nov'],
            ['bulan' => 'Desember', 'angka' => "12", 'singkatan' => 'Des'],
        ];
        return $val;
    }

    public function tahun()
    {
        // mencari menu berdasarkan akses
        $db = \App\Models\Anggotakelas::class;
        $db = new $db;

        $q = $db->select('tahun')->groupBy('tahun')->orderBy('tahun', 'DESC')->find();

        $res = [];
        foreach ($q as $i) {
            $res[] = $i['tahun'];
        }
        return $res;
    }
}
