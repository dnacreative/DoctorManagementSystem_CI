<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Price_Averages extends CI_Migration {

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
            'procedure_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'location_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'avg' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('price_averages',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('price_averages');
    }
}