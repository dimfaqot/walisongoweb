<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SkSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tahun' => 2022,
                'no_sk' => 1,
                'rapat' => "31 Agustus 2022",
                'penetapan' => '1 September 2022',
                'pengangkatan' => '2 September 2022',
                'niy' => 900000000,
                'nama' => 'Asyn Await',
                'ttl' => '19 Agustus 2000',
                'pendidikan' => 'Sarjana Pendidikan Biologi',
                'sub' => 'SD Integral Walisongo Karangmalang',
                'jenis' => 'Guru Tetap Yayasan',
                'jabatan' => 'Guru',
                'tugas' => 'Wali Kelas',
                'no_surat' => '1/SK/YPP-WS/A/VII/2021',
                'ketua' => 'M. Afif Al Ayyubi, S.Ag',
                'ttd' => 'afif.png',
                'kop' => '2022.png',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],

        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('sk')->insertBatch($data);
    }
}
