<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filters_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    /**
     * Отдает массив фильтров
     *
     * @param array $params параметры
     * <br /> array $params['category_ids'] массив id категорий
     * <br /> array $params['ids'] массив id фильтра
     *
     * @return array
     */
    public function getFilters($params = array()) {
        $return = array();
        if (!empty($params['category_ids'])) {
            $where = (array)$params['category_ids'];
            $this->db->where_in('id_category', $where);
        }
        if (!empty($params['ids'])) {
            $where = (array)$params['ids'];
            $this->db->where_in('id', $where);
        }
        $result = $this->db->get('filters');
        if (!empty($result)) {
            $return = $result->result_array();
        }
        return $return;
    }

    /**
     * Добавляет новый фильтр
     *
     * @param array $data массив с данными
     *
     * @return inreget
     */
    public function insertFilters($data = array()) {
        $return = array();
        if (empty($data)) {
            return FALSE;
        }
        $q = $this->db->insert('filters', $data);
        if ($q) {
            $return = $this->db->insert_id();
        }
        return $return;
    }

    /**
     * Обновляем данные фильтров
     *
     * @param array $params параметры
     * integer $params['id'] id записи
     * array $params['data'] обновляеммые данные / поле => значение
     *
     * @return boolean
     */
    public function updateFilters($params = array()) {
        if (empty($params['id'])) {
            return FALSE;
        }
        $id = (int) $params['id'];
        $result = $this->getFilters(array('ids' => $id));
        if (empty($result)) {
            return FALSE;
        }
        $this->db->where('id', $id);
        $result = $this->db->update('filters', $params['data']);
        return $result;
    }

    /**
     * Удаляет данные фильтров
     *
     * @param integer $params['id'] id записи
     *
     * @return array
     */
    public function deleteFilters($params = array()) {
        if (empty($params['id'])) {
            return FALSE;
        }
        $id = (int) $params['id'];
        $this->db->where('id', $id);
        $result = $this->db->delete('filters');
        return $result;
    }

}
