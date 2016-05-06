<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Ratings extends CI_Migration {

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
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'NULL' => TRUE,
            ),
            'left_by' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'NULL' => TRUE,
            ),
            'doctor_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'review' => array(
                'type' => 'TEXT',
                'NULL' => TRUE,
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'NULL' => TRUE,
            ),
            'stars' => array(
                'type' => 'INT',
                'constraint' => 1,
                'NULL' => TRUE,
            ),
            'datetime' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'NULL' => TRUE,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('ratings',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('ratings');
    }
}