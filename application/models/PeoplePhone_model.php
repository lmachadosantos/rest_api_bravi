<?php
/**
 * Created by PhpStorm.
 * User: leandrosantos
 * Date: 07/05/2018
 * Time: 20:26
 */

class PeoplePhone_model extends CI_Model
{
    public $id;

    public $people_id;

    public $type;

    public $number;

    public $created_at;

    public $updated_at = null;

    public function getPeoplePhone($id=null)
    {
        if($id)
            $query = $this->db->get_where( 'people_phones', ['id' => $id] );
        else
            $query = $this->db->get( 'people_phones' );

        return $query->custom_result_object('PeoplePhone_model');
    }

    public function insertPeoplePhone(stdClass $peoplePhone)
    {
        $dateTime = new DateTime('now');
        $this->people_id = $peoplePhone->people_id;
        $this->type = $peoplePhone->type;
        $this->number = $peoplePhone->number;
        $this->created_at = $dateTime->format('Y-m-d H:i:s');

        $this->db->insert('people_phones', $this);

        return $this->db->get_where( 'people_phones', ['id' => $this->db->insert_id()] )->result()[0];
    }

    public function deletePeoplePhoneByPeople(stdClass $peopleEmail)
    {
        return $this->db->delete('people_phones', ['people_id' => $peopleEmail->people_id]);
    }
}