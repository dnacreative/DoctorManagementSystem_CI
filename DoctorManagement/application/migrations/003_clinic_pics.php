<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Clinic_Pics extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'clinic_id' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
            'pic' => array(
                'type' => 'TEXT',
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('clinic_pics',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('clinic_pics');
    }
}