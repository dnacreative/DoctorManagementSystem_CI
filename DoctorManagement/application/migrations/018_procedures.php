<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Procedures extends CI_Migration {

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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'national_avg' => array(
                'type' => 'INT',
                'constraint' => 6,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('procedures',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('procedures');
    }
}