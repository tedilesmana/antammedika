<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Antrian extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'unsigned'       => TRUE,
				'auto_increment' => TRUE
			],
			'current_antrian'          => [
				'type'           => 'INT',
			],
			'total_antrian'          => [
				'type'           => 'INT',
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('antrian');
	}

	public function down()
	{
		$this->forge->dropTable('antrian');
	}
}
