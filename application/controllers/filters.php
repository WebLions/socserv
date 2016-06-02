<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filters extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Выборка данных для добавления фильтра
     */
    public function addFilters() {
        $this->load->model('categories_model');
        $categories = $this->categories_model->getCategories();
        $this->data['categories'] = $categories;
        $this->load->view('admin/category', $this->data);
    }

    /**
     * Выборка данных для редактирования фильтра
     */
    public function editFilter() {
        $get = $this->input->get();
        if (empty($get['id'])) {
            redirect('/404');
        }
        $id = $get['id'];
        if (!is_integer($id)) {
            $id = (int) $id;
        }
        $this->load->model('categories_model');
        $filter = $this->categories_model->getFilters(array('ids' => $id));
        $this->data['filter'] = $filter;
        $this->load->view('admin/filters', $this->data);
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
        $post = $this->input->post();
        if (empty($post)) {
            return FALSE;
        }
        $this->load->model('filters_model');
        $params = array(
            'id' => $post['id'],
        );
        $q = $this->filters_model->deleteFilters($params);
        if (!$q) {
            return FALSE;
        }
        return TRUE;
    }
}
