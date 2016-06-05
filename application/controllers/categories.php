<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@session_start();

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if(!$_SESSION['admin']){
            redirect('/', 'refresh');
        }
        $this->load->model('categories_model');
        $v['categories'] = $this->categories_model->getCategories(array('no_district' => true));
        $this->load->view('admin/header', $v);
        $this->load->view('admin/category/category');
        $this->load->view('admin/footer');
    }
    /**
     * Выборка данных для добавления категории
     */
    public function addCategory() {
        if(!$_SESSION['admin']){
            redirect('/', 'refresh');
        }
        $this->load->library('form_validation');
        $this->load->model('categories_model');
        $this->form_validation->set_rules('name', 'Назва', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $params = array(
                'name' => $this->input->post('name'),
            );
            $this->categories_model->insertCategories($params);
            redirect('/admin/category', 'refresh');
        } else {
            $this->load->view('admin/header');
            $this->load->view('admin/category/category-add');
            $this->load->view('admin/footer');
        }
    }

    /**
     * Выборка данных для редактирования категории
     */
    public function editCategory($id = 0) {
        if(!$_SESSION['admin']){
            redirect('/', 'refresh');
        }
        if (!isset($id) && empty($id)) {
            redirect('/', 'refresh');
        }
        $id = (int) $id;
        $this->load->library('form_validation');
        $this->load->model('categories_model');
        $this->form_validation->set_rules('name', 'Назва', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $params = array(
                'id' => $id,
                'data' => array(
                    'name' => $this->input->post('name'),
                ),
            );
            $this->categories_model->updateCategories($params);
            redirect('/admin/category', 'refresh');
        } else {
            $q = $this->categories_model->getCategories(array('ids' => $id));
            $v = array(
                'name' => '',
                'id' => $id,
            );
            if (!empty($q)) {
                $q = reset($q);
                $v['name'] = $q['name'];
            }
            $this->load->view('admin/header', $v);
            $this->load->view('admin/category/category-edit');
            $this->load->view('admin/footer');
        }
    }

    /**
     * Добавляет новую категорию
     */
    public function insertCategory()
    {
        $post = $this->input->post();
        if (empty($post)) {
            return FALSE;
        }
        $this->load->model('category_model');
        $params = array(
            'name' => $post['name'],
            'id_category' => $post['id_category'],
        );
        $q = $this->categories_model->insertCategories($params);
        if ($q == FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Обновляем данные категории
     */
    public function updateCategory() {
        $post = $this->input->post();
        if (empty($post)) {
            return FALSE;
        }
        $this->load->model('categories_model');
        $params = array(
            'id' => $post['id'],
            'data' => array(
                'name' => $post['name'],
                'id_category' => $post['id_category'],
            ),
        );
        $q = $this->categories_model->updateCategories($params);
        if ($q == FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Удаляет данные категории и их связи
     */
    public function deleteCategory($id = 0) {
        $id = (int) $id;
        if (!isset($id) && empty($id)) {
            return FALSE;
        }
        $this->load->model('categories_model');
        $this->load->model('filters_model');
        $this->load->model('filters_services_model');
        $params = array(
            'ids' => $id,
        );
        $q = $this->categories_model->deleteCategories($params);
        if ($q == FALSE) {
            redirect('/admin/category', 'refresh');
        }
        $params = array(
            'category_ids' => $id,
        );
        $filters = $this->filters_model->getFilters($params);
        $filters_ids = array();
        foreach ($filters as $filter) {
            $filters_ids[] = $filter['id_category'];    
        }
        if (empty($filters_ids)) {
            redirect('/admin/category', 'refresh');
        }
        $params = array(
            'id' => $id,
        );
        $q = $this->filters_model->deleteFilters($params);
        if ($q == FALSE) {
            redirect('/admin/category', 'refresh');
        }
        $params = array(
            'id' => $filters_ids,
        );
        $q = $this->filters_services_model->deleteFiltersServices($params);
        if ($q == FALSE) {
            redirect('/admin/category', 'refresh');
        }
        redirect('/admin/category', 'refresh');
    }
}
