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
            $this->db->or_where_in('id_filter', $id);
        }
        if (!empty($params['services_ids'])) {
            $id = (array) $params['services_ids'];
            $this->db->or_where_in('id_services', $id);
        }
        $result = $this->db->get('filters_services');
        return $result;
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
        if (empty($params['id'])) {
            return FALSE;
        }
        $id = (int) $params['id'];
        $result = $this->getFilters(array('ids' => $id));
        if (empty($result)) {
            return FALSE;
        }
        $this->db->where('id', $id);
        $result = $this->db->update('filters_services', $params['data']);
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
        if (empty($params['id'])) {
            return FALSE;
        }
        $id = (int) $params['id'];
        $this->db->where('id', $id);
        $result = $this->db->delete('filters_services');
        return $result;
    }

}
