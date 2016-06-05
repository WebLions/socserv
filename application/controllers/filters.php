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
        foreach($categories as $key =>$value){
            $category = $this->categories_model->getCategories(array('ids' => $value['id_category']));
            $categories[$key]['category'] = $category[0]['name'];
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
    public function editFilter($id) {
        if (empty($id)) {
            redirect('/404', 'refresh');
        }
        if (!is_integer($id)) {
            $id = (int) $id;
        }
        $this->load->model('filters_model');
        $this->load->model('categories_model');
        $filter = $this->filters_model->getFilters(array('ids' => $id , 'no_district' => true));
        $this->data['filter'] = $filter;
        $categories = $this->categories_model->getCategories(array('no_district' => true));
        $this->data['categories'] = $categories;
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
        header("Location: /admin/filter");
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
        header("Location: /admin/filter");
        return TRUE;
    }

    /**
     * Удаляет данные фильтров
     */
    public function deleteFilters($id) {
        if (empty($id)) {
            return FALSE;
        }
        $this->load->model('filters_model');
        $params = array(
            'id' => $id,
        );
        $q = $this->filters_model->deleteFilters($params);

        if (!$q) {
            return FALSE;
        }
        header("Location: /admin/filter");
        return TRUE;
    }
}
