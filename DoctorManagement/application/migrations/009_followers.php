<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Followers extends CI_Migration {

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
            'handle' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'img' => array(
                'type' => 'TEXT',
                'NULL' => TRUE,
            ),
            'url' => array(
                'type' => 'TEXT',
                'NULL' => TRUE,
            ),
            'description' => array(
                'type' => 'TEXT',
                'NULL' => TRUE,
            ),
            'follower_count' => array(
                'type' => 'INT',
                'constraint' => 8,
            ),
            'status_count' => array(
                'type' => 'INT',
                'constraint' => 8,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('followers',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('followers');
    }
}