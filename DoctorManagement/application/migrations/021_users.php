<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Users extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'NULL' => TRUE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'admin' => array(
                'type' => 'INT',
                'constraint' => 1,
                'NULL' => TRUE,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('users',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}