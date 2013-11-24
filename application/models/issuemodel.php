<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
    class IssueModel extends CI_Model {  
    	function __construct()  
        {  
            parent::__construct();  
        }  
		
		function insert($authorid,$title,$content){
			$this->db->insert("issue", 
				Array(
				"authorid" =>  $authorid,
				"title" => $title,
				"content" => $content,
			));     
			return $this->db->insert_id();
		}   
		
		function addtag($issueID,$tag){
			
			$this->db->select("*");
			$this->db->from("key");
			$this->db->where("tag",$tag);
			$query=$this->db->get(); 
			
			if($query->num_rows() <= 0){			
				$this->db->insert("key", 
					Array(
					"tag" => $tag
				));	
				$tagid=$this->db->insert_id();
				$this->db->insert("tag", 
					Array(
					"issueid" => $issueID,
					"tagid" => $tagid
				));	
			} else{
				$data = array(
				'frequency' => $query->row()->frequency + 1
				);
			
				$this->db->where("tagid",$query->row()->tagid);
				$this->db->update("key",$data);
				$tagid=$query->row()->tagid;
				
				$this->db->insert("tag", 
					Array(
					"issueid" => $issueID,
					"tagid" => $tagid
				));	
			}
			return $tagid;
		}
		
		function follow($userid,$tagid){
			$this->db->select("*");
			$this->db->from("follow");
			$this->db->where("followid",$tagid);
			$this->db->where("userid",$userid);
			$query=$this->db->get(); 
			
			if($query->num_rows() <= 0){
				$this->db->insert("follow", 
					Array(
					"userid" => $userid,
					"followid" => $tagid
				));
			}
		}
		
		function getAllIssues(){
			$this->db->select("issue.*, user.username");
			$this->db->from('issue');
			$this->db->join('user', 'issue.authorid = user.userid');
			$this->db->order_by("timestamp","desc");//由大到小排序
			$query = $this->db->get();

			return $query->result(); 
		}
		
		function getIssue($issueID){
			$this->db->select("issue.*,user.username");  
			$this->db->from('issue');  
			$this->db->join('user', 'issue.authorid = user.userid');  
			$this->db->where("issueid",$issueID);  
			$query = $this->db->get();  
		  
			if ($query->num_rows() <= 0){  
				return null; //無資料時回傳 null  
			}  
		  
			return $query->row(); 
		}
      
    	function getUserIssues($userid){
            $this->db->select("*");
            $this->db->from('issue');

            $this->db->order_by("Timestamp","desc");//由大到小排序
            $this->db->where(Array("authorid" => $userid));

            $query = $this->db->get();

            return $query->result();
        }
		
		function editIssue($issueID, $content){
			date_default_timezone_set('Asia/Taipei');
			$data = Array(
			"content" => $content,
			"timestamp" => date("Y-m-d H:i:s")
			);
			
			$this->db->where("issueid", $issueID);
			$this->db->update("issue", $data);
		}
		
		function deleteIssue($issueID){
			$this->db->select("key.*");  
			$this->db->from('key');  
			$this->db->join('tag', 'tag.tagid = key.tagid');  
			$this->db->where("issueid",$issueID);  
			$query = $this->db->get();
			
			$frequency=$query->row()->frequency - 1;
			
			if($frequency <= 0){
				$this->db->where('tagid', $query->row()->tagid);
				$this->db->delete('key');
			} else{
				$data = Array(
				"frequency" => $frequency,
				);
				
				$this->db->where("tagid", $query->row()->tagid);
				$this->db->update("key", $data);
			}
			
			$this->db->where('issueid', $issueID);
            $this->db->delete('issue');
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