<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filters_services_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает массив связей фильтер - сервис
     *
     * @param array $params параметры
     * array $params['filter_ids'] id фильтров
     * array $params['services_ids'] id сервисов
     *
     * @return array
     */
    public function getFiltersServices($params = array()) {
        if (!empty($params['filter_ids'])) {
            $id = (array) $params['filter_ids'];
            $this->db->where_in('id_filter', $id);
        }
        if (!empty($params['services_ids'])) {
            $id = (array) $params['services_ids'];
            $this->db->where_in('id_services', $id);
        }
        $result = $this->db->get('filters_services');
        return $result->result_array();
    }

    /**
     * Добавляет новую связь
     *
     * @param array $data массив с данными
     *
     * @return inreget
     */
    public function insertFiltersServices($data = array()) {
        $return = array();
        if (empty($data)) {
            return FALSE;
        }
        $q = $this->db->insert_batch('filters_services', $data);
        if ($q) {
            $return = $this->db->insert_id();
        }
        return $return;
    }

    /**
     * Обновляем данные связи
     *
     * @param array $params параметры
     * integer $params['id'] id записи
     * array $params['data'] обновляеммые данные / поле => значение
     *
     * @return boolean
     */
    public function updateFiltersServices($params = array()) {
        if (!empty($params['filter_ids']))
        {
            $id = (array) $params['filter_ids'];
            $result = $this->getFiltersServices(array('filter_ids' => $id));
            if (empty($result)) {
                return FALSE;
            }
            $result = $this->db->update_batch('filters_services', $params['data'],'id_filter');
        }
        if (!empty($params['services_ids']))
        {
            $id = (array) $params['services_ids'];
            $result = $this->getFiltersServices(array('services_ids' => $id));
            if (empty($result)) {
                return FALSE;
            }
            $result = $this->db->update_batch('filters_services', $params['data'],'id_services');
        }
        return $result;
    }

    /**
     * Удаляет связку
     *
     * @param integer $params['id'] id записи
     *
     * @return array
     */
    public function deleteFiltersServices($params = array()) {
        if (!empty($params['id'])) {
            $id = (array) $params['id'];
            $this->db->where_in('id', $id);
        }
        if (!empty($params['filter_ids']))
        {
            $id = (array) $params['filter_ids'];
            $this->db->where_in('id_filter', $id);
        }
        if (!empty($params['services_ids']))
        {
            $id = (array) $params['services_ids'];
            $this->db->where_in('id_services', $id);
        }
        $result = $this->db->delete('filters_services');
        return $result;
    }

}
