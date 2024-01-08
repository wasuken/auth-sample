<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        //
      $this->forge->addField([
        'id' => [
          'type' => 'INT',
          'constrant' => 5,
          'auto_increment' => true,
        ],
        'email' => [
          'type' => 'VARCHAR',
          'constraint' => 100,
        ],
        'password_hash' => [
          'type' => 'VARCHAR',
          'constraint' => 100,
        ],
      ]);
      $this->forge->addKey('id', true);
      $this->forge->createTable('users');
    }

    public function down()
    {
        //
    }
}
