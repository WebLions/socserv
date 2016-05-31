<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getRelations()
    {
        $query = "SELECT `filters_services`.`id_filter`,`filters_services`.`id_services` FROM `filters_services`, `filters`, `services`,`categories` WHERE (`filters_services`.`id_services`=`services`.`id`)AND(`filters_services`.`id_filter`=`filters`.`id`)AND(`filters`.`id_category`=`categories`.`id`)";
//        $this->db->select('filters_services.id_filter, filters_services.id_services');
//        $this->db->from('mytable');
//
//        $query = $this->db->get();
        $query = $this->db->query($query);
        if (!empty($query)) {
            $query = $query->result_array();
        }
        return $query;
    }
}