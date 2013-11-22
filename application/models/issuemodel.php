<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
    class IssueModel extends CI_Model {  
    	function __construct()  
        {  
            parent::__construct();  
        }  
      
    	function getUserIssues($userid){
            $this->db->select("*");
            $this->db->from('issue');
            $this->db->order_by("Timestamp","desc");//由大到小排序
            $this->db->where(Array("AuthorID" => $userid));
            $query = $this->db->get();

            return $query->result();
        }

        function updateViews($issueID,$views){
        	$views = $views+1;
            $data = array(
            'views' => $views,
            );

            $this->db->where('IssueID', $issueID);
            $this->db->update('issue', $data);
        }
    }