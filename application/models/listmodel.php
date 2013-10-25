<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
    class ListModel extends CI_Model {
        function __construct(){
            parent::__construct();
        }
		
        /* This is the function to get data from the table "user" join the table "userstudentid" */
        public function getData(){
        	$this->db->select("*");
        	$this->db->from("user");
        	$this->db->join("userstudentid", "user.userid = userstudentid.userid");
        	$query = $this->db->get();
        
        	if ($query->num_rows() > 0){	// If data exists
        		return $query->result();	// return the object
        	}
        	else{
        		return null;
        	}
        }
        
        /* This is the function to return number of tuples get from data */
		public function getRows(){
			$this->db->select("*");
			$this->db->from("user");
			$this->db->join("userstudentid", "user.userid = userstudentid.userid");
			$query = $this->db->get();
			
			if ($query->num_rows() > 0){	// If data exists
				return $query->num_rows();	// return the number of rows
			}
			else{
				return 0;
			}
		}
		
		
    }

