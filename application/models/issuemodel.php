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
            $this->db->where(Array("authorid" => $userid));
            $query = $this->db->get();

            return $query->result();
        }

        function updateViews($issueID,$views){
        	$views = $views+1;
            $data = array(
                'views' => $views,
            );

            $this->db->where('issueid', $issueID);
            $this->db->update('issue', $data);
        }

        function getIssueContent($issueID){
            $this->db->select("*");
            $this->db->from('issue');
            $this->db->where(Array("issueid" => $issueID));
            $query = $this->db->get();

            return $query->row();
        }
        function getReplyList($issueID){
            $this->db->select("*");
            $this->db->from('reply');
            $this->db->where(Array("issueid" => $issueID));
            $query = $this->db->get();

            return $query->result();
        }
        function getIssueAuthor($authorID){
            $this->db->select("username");
            $this->db->from('user');
            $this->db->where(Array("userid" => $authorID));
            $query = $this->db->get();

            return $query->row()->username;
        }
        function getAuthorID($author){
            $this->db->select("userid");
            $this->db->from('user');
            $this->db->where(Array("username" => $author));
            $query = $this->db->get();

            return $query->row()->userid;
        }
        function insertReply($issueID, $content, $author){
            $this->db->insert("reply",   
                Array(  
                "issueid" =>  $issueID,  
                "replycontent" => $content,
                "userid" => $this->getAuthorID($author)
            ));  
        }
        function getTagArray($issueID){
            $this->db->select("tagid");
            $this->db->from('tag');
            $this->db->where(Array("issueid" => $issueID));
            $query = $this->db->get();
            $tagidList = $query->result();

            $result = null;
            if($tagidList != null){
                $result = array();
                $i = 0;
                foreach($tagidList as $each){
                    $this->db->select("tag");
                    $this->db->from('key');
                    $this->db->where(Array("tagid" => $each->tagid));
                    $query2 = $this->db->get();
                    $result[$i] = $query2->row()->tag;
                    $i++;
                }
            }
            return $result;
        }
    }