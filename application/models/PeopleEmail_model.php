<?php
/**
 * Created by PhpStorm.
 * User: leandrosantos
 * Date: 07/05/2018
 * Time: 18:52
 */

class PeopleEmail_model extends CI_Model
{
    public $id;

    public $people_id;

    public $email;

    public $created_at;

    public $updated_at = null;

    public function getPeopleEmail($id=null)
    {
        if($id)
            $query = $this->db->get_where( 'people_emails', ['id' => $id] );
        else
            $query = $this->db->get( 'people_emails' );

        return $query->custom_result_object('PeopleEmail_model');
    }

    public function insertPeopleEmail(stdClass $peopleEmail)
    {
        $dateTime = new DateTime('now');
        $this->people_id = $peopleEmail->people_id;
        $this->email = $peopleEmail->email;
        $this->created_at = $dateTime->format('Y-m-d H:i:s');

        $this->db->insert('people_emails', $this);

        return $this->db->get_where( 'people_emails', ['id' => $this->db->insert_id()] )->result()[0];
    }

    public function deletePeopleEmailByPeople(stdClass $peopleEmail)
    {
        return $this->db->delete('people_emails', ['people_id' => $peopleEmail->people_id]);
    }
}