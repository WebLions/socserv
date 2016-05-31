<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index()
    {

    }
    public function auth()
    {
        $this->load->model('user_model');
        $this->user_model->auth();
    }
}
