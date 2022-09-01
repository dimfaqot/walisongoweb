<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Color extends Migration
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
            'color' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'secondary' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'support' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'main' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'mid_dark' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'dark' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'mid_light' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'light' => [
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
        $this->forge->createTable('color');
    }

    public function down()
    {
        $this->forge->dropTable('color');
    }
}
