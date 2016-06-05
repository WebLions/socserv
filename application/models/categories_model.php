<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Отдает массив категорий
     *
     * @param array $params параметры
     * <br /> array $params['ids'] массив id категории
     *
     * @return array
     */
    public function getCategories($params = array())
    {
        $return = array();
        if (!empty($params['ids'])) {
            $where = (array)$params['ids'];
            $this->db->where_in('id', $where);
        }
        if (!empty($params['no_district'])) {
            $where = array(2);
            $this->db->where_not_in('id', $where);
        }
        if (!empty($params['page']) && $params['page'] != 0) {
            $page = (int) $params['page'];
            $limit = ($page - 1) * 10;
            $this->db->limit(10, $limit);
        }
        $result = $this->db->get('categories');
        $result = $result->result_array();
        if (!empty($result)) {
            $return = $result;
        }
        return $return;
    }
    /**
     * Добавляет новую категорию
     *
     * @param array $data массив с данными
     *
     * @return inreget
     */
    public function insertCategories($data = array())
    {
        $return = array();
        if (empty($data)) {
            return FALSE;
        }
        $q = $this->db->insert('categories', $data);
        if ($q) {
            $return = $this->db->insert_id();
        }
        return $return;
    }

    /**
     * Обновляем данные категории
     *
     * @param array $params параметры
     * integer $params['id'] id записи
     * array $params['data'] обновляеммые данные / поле => значение
     *
     * @return boolean
     */
    public function updateCategories($params = array()) {
        if (empty($params['id'])) {
            return FALSE;
        }
        $id = (int) $params['id'];
        $result = $this->getCategories(array('ids' => $id));
        if (empty($result)) {
            return FALSE;
        }
        $this->db->where('id', $id);
        $result = $this->db->update('categories', $params['data']);
        return $result;
    }

    /**
     * Удаляет категорию
     *
     * @param integer $params['ids'] id записи
     *
     * @return array
     */
    public function deleteCategories($params = array()) {
        if (empty($params['ids'])) {
            return FALSE;
        }
        $ids = (array) $params['ids'];
        $this->db->where_in('id', $ids);
        $result = $this->db->delete('categories');
        return $result;
    }
}

