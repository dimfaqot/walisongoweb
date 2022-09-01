<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
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
            'role_id' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'menu' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'query' => [
                'type' => 'VARCHAR',
                'constraint' => 5000
            ],
            'preview' => [
                'type' => 'VARCHAR',
                'constraint' => 5000
            ],
            'calls' => [
                'type' => 'VARCHAR',
                'constraint' => 5000
            ],
            'reload' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'limits' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'contents' => [
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
        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
