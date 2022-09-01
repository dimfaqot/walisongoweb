<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tema extends Migration
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
                'type' => 'INT',
                'constraint' => 2,
            ],
            'color_id' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'tema' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'font_size' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
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
        $this->forge->createTable('tema');
    }

    public function down()
    {
        $this->forge->dropTable('tema');
    }
}
