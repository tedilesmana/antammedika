<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pasiens extends Migration
{
        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'                   => 'INT',
                                'unsigned'               => true,
                                'auto_increment'         => true,
                        ],
                        'user_id'       => [
                                'type'                   => 'INT',
                                'unsigned'               => true,
                        ],
                        'name'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '50',
                        ],
                        'age'       => [
                                'type'           => 'INT',
                                'constraint'     => '5',
                        ],
                        'phone'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '255',
                        ],
                        'antrian'       => [
                                'type'           => 'INT',
                                'constraint'     => '5',
                        ],
                        'description'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '255',
                        ],
                        'status'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '255',
                        ],
			'address' 		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '225',
			],
			'created_at' 			=> [
				'type' 				=> 'varchar',
				'constraint' 		=> 250,
				'null' 				=> true,
				'on create' 		=> 'NOW()'
			],
			'updated_at' 			=> [
				'type' 				=> 'varchar',
				'constraint' 		=> 250,
				'null' 				=> true,
				'on update' 		=> 'NOW()'
			],
			'deleted_at' 			=> [
				'type' 				=> 'varchar',
				'constraint' 		=> 250,
				'null' 				=> true,
				'on delete' 		=> 'NOW()'
			],
                ]);
                $this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
                $this->forge->createTable('pasiens');
        }

        public function down()
        {
                $this->forge->dropTable('pasiens');
        }
}
