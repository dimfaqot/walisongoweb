<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'color' => 'Info',
                'main' => '#0DCAF0',
                'secondary' => '#EAF8FB',
                'support' => '#EAF8FB',
                'mid_dark' => '#66CBDF',
                'dark' => '#0F6273',
                'mid_light' => '#C4F0FA',
                'light' => '#F4FDFF',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'color' => 'danger',
                'main' => '#F0430D',
                'secondary' => '#FBEAEA',
                'support' => '#EAF8FB',
                'mid_dark' => '#DF6666',
                'dark' => '#73270F',
                'mid_light' => '#FAC4C4',
                'light' => '#FFF4F4',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'color' => 'warning',
                'main' => '#F0B00D',
                'secondary' => '#FBF8EA',
                'support' => '#EAF8FB',
                'mid_dark' => '#DFBD66',
                'dark' => '#735D0F',
                'mid_light' => '#FAE8C4',
                'light' => '#FFFFF4',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'color' => 'success',
                'main' => '#0DF083',
                'secondary' => '#EAFBF5',
                'support' => '#EAF8FB',
                'mid_dark' => '#66DF9E',
                'dark' => '#0F7325',
                'mid_light' => '#C4FAD6',
                'light' => '#F6FFF4',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'color' => 'primary',
                'main' => '#0D9EF0',
                'secondary' => '#EAEBFB',
                'support' => '#EAF8FB',
                'mid_dark' => '#66B3DF',
                'dark' => '#0F5B73',
                'mid_light' => '#C4D6FA',
                'light' => '#F4FCFF',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],

        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('color')->insertBatch($data);
    }
}
