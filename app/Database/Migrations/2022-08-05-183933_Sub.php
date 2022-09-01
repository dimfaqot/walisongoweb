<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sub extends Migration
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
            'sub' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'sub_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'no_izin' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'kepala' => [
                'type' => 'VARCHAR',
                'constraint' => 255
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
        $this->forge->createTable('sub');
    }

    public function down()
    {
        $this->forge->dropTable('sub');
    }
}
