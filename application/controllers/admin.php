<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@session_start();

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    public function index()
    {
        if( isset($_SESSION['admin']) && $_SESSION['admin'])
        {
            $this->load->model('service_model');
            $this->data['services'] = $this->service_model->getServices();
//            $this->load->model('categories_model');
//            $this->load->model('filters_model');
//            $this->data['categories'] = $this->categories_model->getCategories();
//            foreach ($this->data['categories'] as $key=>$value) {
//                $params['category_ids'] = $value['id'];
//                $this->data['categories'][$key]['values'] = $this->filters_model->getFilters($params);
//            }
            //главная страница — Социальные службы
            $this->load->view('admin/header');
            $this->load->view('admin/home', $this->data);
            $this->load->view('admin/footer');
        }
        else
        {
            $this->load->view('admin/login');
        }

    }
    public function auth()
    {
        $post = $this->input->post();
        if (empty($post)) {
            return false;
        }
        $this->load->model('user_model');
        $post['password'] = md5($post['password']);
        $data = array('login' => $post['login'], 'password' => $post['password']);
        if ($this->user_model->auth($data)) {
            $_SESSION['admin'] = true;
            redirect('/admin', 'refresh');
        } else {
            echo 'Ошибка авторизации';
        }
    }
    public function settings(){
        $this->load->view('admin/header');
        $this->load->view('admin/settings/settings.php');
        $this->load->view('admin/footer');
    }
    public function change_password()
    {
        $post = $this->input->post();
        if (empty($post)) {
            return false;
        }
        $this->load->model('user_model');

    }

    public function logout(){
        if(isset($_SESSION['admin']) && $_SESSION['admin'])
        {
            $_SESSION['admin'] = false;
        }
        redirect('/', 'refresh');
    }
//
//    public function login(){
//        $this->load->view('/admin/login');
//    }
//    public function home(){
//        $this->load->view('/admin/home');
//    }
}
