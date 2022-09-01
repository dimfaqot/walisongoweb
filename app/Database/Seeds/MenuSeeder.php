<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_id' => 0,
                'menu' => 'Dashboard',
                'icon' => "fa fa-tachometer",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'role_id' => 0,
                'menu' => 'Role',
                'icon' => "fa fa-gavel",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'role_id' => 0,
                'menu' => 'Menu',
                'icon' => "fa fa-tasks",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'role_id' => 0,
                'menu' => 'Tahun',
                'icon' => "fa fa-calendar",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'role_id' => 0,
                'menu' => 'Pengurus',
                'icon' => "fa fa-laptop",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'role_id' => 0,
                'menu' => 'Santri',
                'icon' => "fa fa-street-view",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'role_id' => 0,
                'menu' => 'Kelas',
                'icon' => "fa fa-graduation-cap",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'role_id' => 0,
                'menu' => 'Nilai',
                'icon' => "fa fa-sticky-note",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'role_id' => 0,
                'menu' => 'Dokumen',
                'icon' => "fa fa-clone",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'role_id' => 0,
                'menu' => 'Cetak',
                'icon' => "fa fa-file-pdf-o",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'role_id' => 0,
                'menu' => 'Settings',
                'icon' => "fa fa-cog",
                'query' => "table menu join submit role_id,icon diffsubmit l:role_id=Role,l:menu=Menussss role,role_id=role.id,left orderby menu.id,DESC",
                'reload' => '',
                'limits' => 10,
                'contents' => 'alert,header,body,menu,footer',
                'preview' => 'bestof,klasemen',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]

        ];

        // Simple Queries
        // $this->db->query('INSERT INTO role (role, created_at, updated_at) VALUES(:role:, :created_at:, :updated_at:)', $data);

        // Using Query Builder
        // $this->db->table('role')->insert($data);
        $this->db->table('menu')->insertBatch($data);
    }
}
