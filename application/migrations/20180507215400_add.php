<?php

class Migration_Add extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('people');



        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'people_id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('people_emails');


        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'people_id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'type' => array(
                'type' => 'ENUM("R","C","W")'
            ),
            'number' => array(
                'type' => 'BIGINT',
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('people_phones');

        $this->db->query("ALTER TABLE `people_emails` ADD FOREIGN KEY(`people_id`) REFERENCES people(`id`) ON DELETE CASCADE;");
        $this->db->query("ALTER TABLE `people_phones` ADD FOREIGN KEY(`people_id`) REFERENCES people(`id`) ON DELETE CASCADE;");
    }

    public function down()
    {
        $this->dbforge->drop_table('people');
        $this->dbforge->drop_table('people_phones');
        $this->dbforge->drop_table('people_emails');
    }
}