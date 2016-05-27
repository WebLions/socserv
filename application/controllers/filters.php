<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filters_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
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
