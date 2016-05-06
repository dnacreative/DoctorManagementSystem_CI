<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Education extends CI_Migration {

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
            'school' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'img' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('education',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('education');
    }
}