<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Masonry extends CI_Migration {

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
            'doctor_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'img' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'title' => array(
                'type' => 'TEXT',
            ),
            'description' => array(
                'type' => 'TEXT',
            ),
            'order' => array(
                'type' => 'INT',
                'constraint' => 2,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('masonry',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('masonry');
    }
}