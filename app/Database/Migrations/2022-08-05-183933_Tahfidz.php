<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tahfidz extends Migration
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
            'tanggal' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'bulan' => [
                'type' => 'VARCHAR',
                'constraint' => 2
            ],
            'anggotakelas_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'akhlaq_pengurus' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'akhlaq_guru' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'kedisiplinan_ketertiban' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'kedisiplinan_kerapian' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'kedisiplinan_pelanggaran' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'absen' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'nilai' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'juz' => [
                'type' => 'INT',
                'constraint' => 5
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
        $this->forge->createTable('tahfidz');
    }

    public function down()
    {
        $this->forge->dropTable('tahfidz');
    }
}
