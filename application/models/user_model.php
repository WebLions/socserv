<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

   public function auth($data)
   {
       if(isset($data['login']) && isset($data['password']))
       {
           $this->db->where('login', $data['login']);
           $this->db->where('password', $data['password']);
           $return = $this->db->get('users');
           if ($return->result_id->num_rows){
               return true;
           }
           else return false;
       }


   }
}