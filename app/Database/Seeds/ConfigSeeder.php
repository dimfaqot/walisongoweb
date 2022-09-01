<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'code' => 'kop',
                'value' => 'kop399A8HMuCQhxAz4mq2UfETtKxR9AxhXvWy8MUAPcQVNFhb9X6G',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'code' => 'kops',
                'value' => '2006.png,2013.png,2021.png',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'code' => 'ttd',
                'value' => 'ttdj75uTw4jhqQAHqXXt7hyfdyfE3UVVsTKDMPuKeR23AznbfaMJq',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'code' => 'ttds',
                'value' => 'abah.png,afif.png',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'code' => 'ktp',
                'value' => 'ktpf88Xw9QjTH7uyADkha58xCaX2dF9wRmQ2Ys5NvrF9W6Uuhz5RY',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'code' => 'kk',
                'value' => 'kksHCf8N4EEzGWX9JsXqBCDRrc5J2DDmgjr6VDQC4uXUD782589e',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'code' => 'profile',
                'value' => 'imghmHfA2YgUcKgvkMjYvyDwhBPUCN5b4gkaZD2BJQfDFjJt5hFkq',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'code' => 'berkas',
                'value' => 'berkasjUR825fZVHBPSEN3jcYVEEm96qHUWMY26Keyq3qRD8pHNXS9J6',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],

        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('config')->insertBatch($data);
    }
}
