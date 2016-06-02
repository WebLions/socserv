<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Выборка данных для добавления категории
     */
    public function addCategory() {
        $this->load->view('admin/category');
    }

    /**
     * Выборка данных для редактирования категории
     */
    public function editCategory() {
        $get = $this->input->get();
        if (empty($get['id'])) {
            redirect('/404', 'refresh');
        }
        $id = $get['id'] = 2;
        if (!is_integer($id)) {
            $id = (int) $id;
        }
        $this->load->model('categories_model');
        $category = $this->categories_model->getCategories(array('ids' => $id));
        $category = reset($category);
        $this->data['category_name'] = $category['name'];
        $this->load->view('admin/filters', $this->data);
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
    public function deleteCategory() {
        $post = $this->input->post();
        if (empty($post)) {
            return FALSE;
        }
        $this->load->model('categories_model');
        $this->load->model('filters_model');
        $this->load->model('filters_services_model');
        $params = array(
            'id' => $post['id'],
        );
        $q = $this->category_model->deleteCategories($params);
        if ($q == FALSE) {
            return FALSE;
        }
        $params = array(
            'category_ids' => $post['id'],
        );
        $filters = $this->filters_model->getFilters($params);
        $filters_ids = array();
        foreach ($filters as $filter) {
            $filters_ids[] = $filter['id_category'];    
        }
        if (empty($filters_ids)) {
            return TRUE;
        }
        $params = array(
            'id' => $post['id'],
        );
        $q = $this->filters_model->deleteFilters($params);
        if ($q == FALSE) {
            return FALSE;
        }
        $params = array(
            'id' => $filters_ids,
        );
        $q = $this->filters_services_model->deleteFiltersServices($params);
        if ($q == FALSE) {
            return FALSE;
        }
        return TRUE;
    }
}
