<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 1
            ],
            'ttl' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'kelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'kecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'kabupaten' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'provinsi' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'hp' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'ktp' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'kk' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'profile' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'berkas' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'ket' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'gelar' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => 1000
            ],
            'sub' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
