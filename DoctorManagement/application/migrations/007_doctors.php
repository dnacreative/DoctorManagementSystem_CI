<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Doctors extends CI_Migration {

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
            'npi' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'NULL' => TRUE,
            ),
            'license' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'field' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'NULL' => TRUE,
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'website' => array(
                'type' => 'TEXT',
                'NULL' => TRUE,
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
            'state' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'NULL' => TRUE,
            ),
            'zip_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'NULL' => TRUE,
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 30,
                'NULL' => TRUE,
            ),
            'lon' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'NULL' => TRUE,
            ),
            'lat' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'NULL' => TRUE,
            ),
            'angle' => array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'NULL' => TRUE,
            ),
            'tilt' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'NULL' => TRUE,
            ),
            'map_lon' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'NULL' => TRUE,
            ),
            'map_lat' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'NULL' => TRUE,
            ),
            'rating' => array(
                'type' => 'INT',
                'constraint' => 11,
                'NULL' => TRUE,
            ),
            'bio' => array(
                'type' => 'TEXT',
                'NULL' => TRUE,
            ),
            'discoverable' => array(
                'type' => 'INT',
                'constraint' => 1,
                'NULL' => TRUE,
            ),
            'dox_field' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'NULL' => TRUE,
            ),
            'masonry' => array(
                'type' => 'INT',
                'constraint' => 1,
                'NULL' => TRUE,
            ),
            'address_line_two' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'NULL' => TRUE,
            ),
        ));

        $this->dbforge->add_key("id",TRUE);
        $this->dbforge->create_table('doctors',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('doctors');
    }
}