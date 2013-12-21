<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
    class MobileModel extends CI_Model {  
    	function __construct()  
        {  
            parent::__construct();  
        }  

        function getPhoneNum($username){
			$this->db->select("userid, username, phone");  
			$this->db->from('user');  
			$this->db->where("username",$username);  
			$query = $this->db->get();  
		  
			if ($query->num_rows() <= 0){  
				return null; //無資料時回傳 null  
			}  
		  
			return $query->row(); 
		}
    }	