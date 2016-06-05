<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filters extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->load->model('filters_model');
        $this->load->model('categories_model');

        $categories = $this->filters_model->getFilters(array('no_district' => true));
        foreach($categories as $value){
            $categories['category'] = $this->categories_model->getCategories(array('ids' => $value['id_category']));
        }
        $this->data['filters'] = $categories;
        $this->load->view('admin/header');
        $this->load->view('admin/filters/filters', $this->data);
        $this->load->view('admin/footer');
    }
    /**
     * Выборка данных для добавления фильтра
     */
    public function addFilters() {
        $this->load->model('categories_model');
        $categories = $this->categories_model->getCategories(array('no_district' => true));
        $this->data['categories'] = $categories;
        $this->load->view('admin/header');
        $this->load->view('admin/filters/filter-add', $this->data);
        $this->load->view('admin/footer');
    }

    /**
     * Выборка данных для редактирования фильтра
     */
    public function editFilter() {
        $get = $this->input->get();
        if (empty($get['id'])) {
            redirect('/404', 'refresh');
        }
        $id = $get['id'];
        if (!is_integer($id)) {
            $id = (int) $id;
        }
        $this->load->model('filters_model');
        $filter = $this->filters_model->getFilters(array('ids' => $id , 'no_district' => true));
        $this->data['filter'] = $filter;
        $this->load->view('admin/header');
        $this->load->view('admin/filters/filter-edit', $this->data);
        $this->load->view('admin/footer');
    }

    /**
     * Добавляет новый фильтр
     */
    public function insertFilters()
    {
        $post = $this->input->post();
        if (empty($post)) {
            return FALSE;
        }
        $this->load->model('filters_model');
        $params = array(
            'name' => $post['name'],
            'id_category' => $post['id_category'],
        );
        $q = $this->filters_model->insertFilters($params);
        if (!$q) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Обновляем данные фильтров
     */
    public function updateFilters() {
        $post = $this->input->post();
        if (empty($post)) {
            return FALSE;
        }
        $this->load->model('filters_model');
        $params = array(
            'id' => $post['id'],
            'data' => array(
                'name' => $post['name'],
                'id_category' => $post['id_category'],
            ),
        );
        $q = $this->filters_model->updateFilters($params);
        if (!$q) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Удаляет данные фильтров
     */
    public function deleteFilters() {
        $get = $this->input->get();
        if (empty($get)) {
            return FALSE;
        }
        $this->load->model('filters_model');
        $params = array(
            'filter_id' => $get['id'],
        );
        $q = $this->filters_model->deleteFilters($params);
        if (!$q) {
            return FALSE;
        }
        return TRUE;
    }
}
