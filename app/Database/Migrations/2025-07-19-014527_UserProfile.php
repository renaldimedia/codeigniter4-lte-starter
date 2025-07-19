<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;

class UserProfile extends Migration
{

    /**
     * @var string[]
     */
    private array $tables;

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);

        /** @var \Config\Auth $authConfig */
        $authConfig   = config('Auth');
        $this->tables = $authConfig->tables;
    }


    public function up()
    {

        $fields = [
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 1024
            ]
        ];
        $this->forge->addColumn($this->tables['users'], $fields);
    }

    public function down()
    {
        $fields = [
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 1024
            ]
        ];
        $this->forge->dropColumn($this->tables['users'], $fields);
    }
}
