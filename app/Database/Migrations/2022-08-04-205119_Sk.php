<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sk extends Migration
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
            'tahun' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'no_sk' => [
                'type' => 'INT',
                'constraint' => 4
            ],
            'rapat' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'penetapan' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'pengangkatan' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'niy' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'ttl' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'sub' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'tugas' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'no_surat' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'ketua' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'ttd' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'kop' => [
                'type' => 'VARCHAR',
                'constraint' => 100
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
        $this->forge->createTable('sk');
    }

    public function down()
    {
        $this->forge->dropTable('sk');
    }
}
