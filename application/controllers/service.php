<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@session_start();

class Service extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    public function add()
    {
        if(!$_SESSION['admin']){
            return false;
        }
        $this->load->model('categories_model');
        $this->load->model('filters_model');

        $this->data['categories'] = $this->categories_model->getCategories();
        foreach ($this->data['categories'] as $key=>$value) {
            $params['category_ids'] = $value['id'];
            $this->data['categories'][$key]['values'] = $this->filters_model->getFilters($params);
        }
        $this->load->view('admin/header');
        $this->load->view('admin/service/service-add', $this->data);
        $this->load->view('admin/footer');
    }
    //Добавление адресов в фильтры автоматически
    public function add_post()
    {
        if(!$_SESSION['admin']){
            return false;
        }
        $post = $this->input->post();
        if (empty($post)) {
            return false;
        }
        $this->load->model('service_model');
        $service = array(
            'name'=> $post['name'],
            'description'=>$post['description'],
            'adres'=>$post['adres'],
            'phone'=>$post['phone'],
            'coordinates'=>$post['coordinates'],
        );
        $id_service = $this->service_model->insertServices($service);
        if (!empty($post['disctrict'])) {
            $this->load->model('filters_model');
            $q = $this->filters_model->getFilters(array('name' => $post['disctrict'], 'category_ids' => 2));
            if (!empty($q)) {
                $params = array(
                    'name' => $post['disctrict'],
                    'category_ids' => 2,
                );
                $id = $this->filters_model->addFilters(array('name' => $post['disctrict']));
                $post['id_filter'] = (isset($post['id_filter']) ? array_push($post['id_filter'], $id) : $id);
            }
        }
        if(isset($post['id_filter'])){
            $this->load->model('filters_services_model');
            $relations = array();
            foreach($post['id_filter'] as $value)
            {
                $array = array('id_services' => $id_service, 'id_filter' => $value);
                $relations[] = $array;
            }
            $this->filters_services_model->insertFiltersServices($relations);
        }
    }
    public function edit($id){
        if(!$_SESSION['admin']){
            return false;
        }
        //Загружаем данные про службу
        $this->load->model('service_model');
        $parameters = array('ids' => $id);
        $this->data['service'] = $this->service_model->getServices($parameters);

        //Загружаем категории
        $this->load->model('categories_model');
        $this->load->model('filters_model');
        $this->data['categories'] = $this->categories_model->getCategories();
        foreach ($this->data['categories'] as $key=>$value) {
            $params['category_ids'] = $value['id'];
            $this->data['categories'][$key]['values'] = $this->filters_model->getFilters($params);
        }

        //Выбираем какая категория принадлежит службе
        $this->load->model('filters_services_model');
        $par = array('services_ids' => $this->data['service'][0]['id']);
        $this->data['checked'] = $this->filters_services_model->getFiltersServices($par);

        $this->load->view('admin/header');
        $this->load->view('admin/service/service-edit', $this->data);
        $this->load->view('admin/footer');
    }
    public function edit_post(){
        if(!$_SESSION['admin']){
            return false;
        }
        $post = $this->input->post();
        if (empty($post)) {
            return false;
        }
        $this->load->model('service_model');
        $service = array(
            'id' => $post['id'],
            'data' => array(
                'name'=> $post['name'],
                'description'=>$post['description'],
                'adres'=>$post['adres'],
                'phone'=>$post['phone'],
                'coordinates'=>$post['coordinates'],
            )
        );
        $this->service_model->updateServices($service);
        if(isset($post['id_filter'])){
            $this->load->model('filters_services_model');
            $relations = array();
            foreach($post['id_filter'] as $value)
            {
                $array = array('id_services' =>$post['id'], 'id_filter' => $value);
                $relations['data'] = $array;
            }
            $relations['services_ids'] = $post['id'];
            $this->filters_services_model->updateFiltersServices($relations);
        }

    }
    public function delete($id)
    {
        if(!$_SESSION['admin']){
            return false;
        }
        $delete = array('id' => $id);
        $this->load->model('service_model');
        $this->service_model->deleteServices($delete);
        $this->load->model('filters_services_model');
        $this->filters_services_model->deleteFiltersServices(array('services_ids'=>$id));
        header('Location: /admin');
    }


}