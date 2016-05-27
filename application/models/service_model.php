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

}