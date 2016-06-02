<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@session_start();

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    public function index()
    {
        if($_SESSION['admin'])
        {
            $this->load->model('service_model');
            $this->data['services'] = $this->service_model->getServices();
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
            $this->load->view('admin/home', $this->data);
        } else {
            echo 'Ошибка авторизации';
        }
    }

    public function login(){
        $this->load->view('/admin/login');
    }
    public function home(){
        $this->load->view('/admin/home');
    }
    //Службы
    //Фильтры
        //добавить
        //удалить
        //редактировать
    //Категории
        //добавить
        //удалить
        //редактировать
    //Сменить пароль

}
