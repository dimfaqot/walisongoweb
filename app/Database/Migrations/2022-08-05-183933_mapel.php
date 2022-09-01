<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mapel extends Migration
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
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'angkatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'mapel' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'sks' => [
                'type' => 'INT',
                'constraint' => 1
            ],
            'kkm' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'pengajar' => [
                'type' => 'VARCHAR',
                'constraint' => 128
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
        $this->forge->createTable('mapel');
    }

    public function down()
    {
        $this->forge->dropTable('mapel');
    }
}
