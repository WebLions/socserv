<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {

    /**
     * Отдает массив сервисов
     *
     * @param array $params параметры
     * <br /> array $params['ids'] массив id сервисов
     *
     * @return array
     */
    public function getServices($params = array())
    {
        
        $return = array();
        if (!empty($params['ids'])) {
            $where = (array)$params['ids'];
            $this->db->where_in('id', $where);
        }
        $result = $this->db->get('services');
        if (!empty($result)) {
            $return = $result->result_array();
        }
        return $return;
    }

    /**
     * Добавляет новый сервис
     *
     * @param array $data массив с данными
     *
     * @return inreget
     */
    public function insertServices($data = array()) {
        $return = array();
        if (empty($data)) {
            return FALSE;
        }
        $q = $this->db->insert('services', $data);
        if ($q) {
            $return = $this->db->insert_id();
        }
        return $return;
    }

    /**
     * Обновляем данные сервиса
     *
     * @param array $params параметры
     * integer $params['id'] id записи
     * array $params['data'] обновляеммые данные / поле => значение
     *
     * @return boolean
     */
    public function updateServices($params = array()) {
        if (empty($params['id'])) {
            return FALSE;
        }
        $id = (int) $params['id'];
        $result = $this->getServices(array('ids' => $id));
        if (empty($result)) {
            return FALSE;
        }
        $this->db->where('id', $id);
        $result = $this->db->update('services', $params['data']);
        return $result;
    }

    /**
     * Удаляет сервис
     *
     * @param integer $params['id'] id записи
     *
     * @return array
     */
    public function deleteServices($params = array()) {
        if (empty($params['id'])) {
            return FALSE;
        }
        $id = (int) $params['id'];
        $this->db->where('id', $id);
        $result = $this->db->delete('services');
        return $result;
    }

}
