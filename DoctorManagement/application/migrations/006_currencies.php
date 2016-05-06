<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Currencies extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'currency' => array(
                'type' => 'VARCHAR',
                'constraint' => 3,
            ),
            'rate' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('currencies',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('currencies');
    }
}