<?php
/**
 * Created by PhpStorm.
 * User: leandrosantos
 * Date: 07/05/2018
 * Time: 17:42
 */

class People_model extends CI_Model
{
    public $id;

    public $name;

    public $created_at;

    public $updated_at = null;

    public function getPeople($id=null)
    {
        if($id)
            $query = $this->db->get_where( 'people', ['id' => $id] );
        else
            $query = $this->db->get( 'people' );

        return $query->custom_result_object('People_model');
    }

    public function insertPeople(stdClass $people)
    {
        $dateTime = new DateTime('now');
        $this->name = $people->name;
        $this->created_at = $dateTime->format('Y-m-d H:i:s');

        $this->db->insert('people', $this);

        return $this->db->get_where( 'people', ['id' => $this->db->insert_id()] )->result()[0];
    }

    public function updatePeople(stdClass $people)
    {
        $oldPeople = $this->getPeople($people->id)[0];
        $dateTime = new DateTime('now');

        $this->id = $oldPeople->id;
        $this->name = $people->name;
        $this->created_at = $oldPeople->created_at;
        $this->updated_at = $dateTime->format('Y-m-d H:i:s');

        $this->db->update('people', $this, ['id' => $people->id]);

        return $this->db->get_where( 'people', ['id' => $people->id] )->result()[0];
    }

    public function deletePeople(stdClass $people)
    {
        return $this->db->delete('people', ['id' => $people->id]);
    }
}