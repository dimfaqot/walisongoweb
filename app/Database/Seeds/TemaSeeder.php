<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TemaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_id' => 1,
                'color_id' => 1,
                'tema' => 'main',
                'font_size' => 'smaller',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('tema')->insertBatch($data);
    }
}
