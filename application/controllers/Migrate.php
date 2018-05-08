<?php
/**
 * Created by PhpStorm.
 * User: leandrosantos
 * Date: 07/05/2018
 * Time: 21:48
 */

class Migrate extends CI_Controller
{

    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode( [ 'status' => 200, 'message' => 'Migrate successfully.']));
    }

}