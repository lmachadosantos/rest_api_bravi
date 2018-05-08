<?php
/**
 * Created by PhpStorm.
 * User: leandrosantos
 * Date: 07/05/2018
 * Time: 18:12
 */

class People extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('People_model');
        $this->load->model('PeopleEmail_model');
        $this->load->model('PeoplePhone_model');
    }

    public function get($id=null)
    {
        $people = $this->People_model->getPeople($id);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode( [ 'data' => $people, 'status' => 200, 'message' => 'Request successfully.']));
    }

    public function add()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'POST'){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode([ 'status' => 400, 'message' => 'Bad request.']));
        } else {

            $request = json_decode(file_get_contents("php://input"));
            $emails = [];
            $phones = [];
            $people = new stdClass();

            $people->name = $request->name;
            $People_model = $this->People_model->insertPeople($people);

            $people->emails = new stdClass();
            $people->phones = new stdClass();

            if(isset($request->emails)) {
                foreach ($request->emails as $email) {
                    $peopleEmail = new stdClass();
                    $peopleEmail->people_id = $People_model->id;
                    $peopleEmail->email = $email->email;

                    $PeopleEmail_model = $this->PeopleEmail_model->insertPeopleEmail($peopleEmail);

                    array_push($emails, $PeopleEmail_model);
                }
            }

            if(isset($request->phones)) {
                foreach ($request->phones as $phone) {
                    $peoplePhone = new stdClass();
                    $peoplePhone->people_id = $People_model->id;
                    $peoplePhone->type = $phone->type;
                    $peoplePhone->number = $phone->number;

                    $PeoplePhone_model = $this->PeoplePhone_model->insertPeoplePhone($peoplePhone);

                    array_push($phones, $PeoplePhone_model);
                }
            }

            $people->emails = $emails;
            $people->phones = $phones;

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode( [ 'data' => $people, 'status' => 200, 'message' => 'Data inserted successfully.']));
        }
    }

    public function update($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'PUT' || !$id){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode([ 'status' => 400, 'message' => 'Bad request.']));
        } else {

            $request = json_decode(file_get_contents("php://input"));
            $emails = [];
            $phones = [];
            $people = new stdClass();

            $people->id = $id;
            $people->name = $request->name;
            $People_model = $this->People_model->updatePeople($people);

            $people->emails = new stdClass();
            $people->phones = new stdClass();

            if(isset($request->emails)) {
                $peopleEmail = new stdClass();
                $peopleEmail->people_id = $People_model->id;
                $this->PeopleEmail_model->deletePeopleEmailByPeople($peopleEmail);

                foreach ($request->emails as $email) {
                    $peopleEmail = new stdClass();
                    $peopleEmail->people_id = $People_model->id;
                    $peopleEmail->email = $email->email;

                    $PeopleEmail_model = $this->PeopleEmail_model->insertPeopleEmail($peopleEmail);

                    array_push($emails, $PeopleEmail_model);
                }
            }

            if(isset($request->phones)) {
                $peoplePhone = new stdClass();
                $peoplePhone->people_id = $People_model->id;
                $this->PeoplePhone_model->deletePeoplePhoneByPeople($peoplePhone);

                foreach ($request->phones as $phone) {
                    $peoplePhone = new stdClass();
                    $peoplePhone->people_id = $People_model->id;
                    $peoplePhone->type = $phone->type;
                    $peoplePhone->number = $phone->number;

                    $PeoplePhone_model = $this->PeoplePhone_model->insertPeoplePhone($peoplePhone);

                    array_push($phones, $PeoplePhone_model);
                }
            }

            $people->emails = $emails;
            $people->phones = $phones;

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode( [ 'data' => $people, 'status' => 200, 'message' => 'Data updated successfully.']));

        }
    }

    public function delete($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'DELETE' || !$id){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode([ 'status' => 400, 'message' => 'Bad request.']));
        } else {

            $people = new stdClass();
            $people->id = $id;

            $this->People_model->deletePeople($people);

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode( [ 'status' => 200, 'message' => 'Data deleted successfully.']));
        }
    }
}