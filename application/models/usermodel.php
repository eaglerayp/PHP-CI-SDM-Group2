<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
    class UserModel extends CI_Model {  
        function __construct()  
        {  
            parent::__construct();  
        }  
 		function insert($account,$password){  
        	$this->db->insert("user",   
            Array(  
            "UserID" =>  $account,  
            "password" => $password  
        ));  
  	    } 
  	    function checkUserExist($account){  
        	$this->db->select("COUNT(*) AS users");  
        	$this->db->from("user");  
        	$this->db->where("UserID", $account);  
        	$query = $this->db->get();   
      
        	return $query->row()->users > 0 ;  
    	}  
        public function getUser($account){  
            $this->db->select("userid,username");  
            $query = $this->db->get_where("ssodb",Array("userid" => $account));  
      
            if ($query->num_rows() > 0){ //如果數量大於0  
                return $query->row();  //回傳第一筆  
            }
            else{  
                return null;  
            }  
        }

        function getUserfile($account){  
            $this->db->select("*");  
            $query = $this->db->get_where("user",Array("userid" => $account));  
      
            if ($query->num_rows() > 0){ //如果數量大於0  
                return $query->row();  //回傳第一筆  
            }
            else{  
                return null;  
            }  
        }

        function getUserwork($account){  
            $this->db->select("*");  
            $this->db->order_by("state", "asc"); 
            $query = $this->db->get_where("userwork",Array("userid" => $account));  
            
            if ($query->num_rows() > 0){ //如果數量大於0  
                return $query->result();  //回傳全部
            }
            else{  
                return null;  
            }  
        }

        function getUserstudentid($account){  
            $this->db->select("*");  
            $query = $this->db->get_where("userstudentid",Array("userid" => $account));  
        
            if ($query->num_rows() > 0){ //如果數量大於0  
                return $query->result();  //回傳全部
            }
            else{  
                return null;  
            }  
        }

        function updateUser($userid,$email,$address,$phone,$addressshow,$phoneshow,$autobiography,$usercategory,$imgpath,$positionshow,$employershow){
            $data = array(
            'email' => $email,
            'address' => $address,
            'addressshow' => $addressshow,
            'phone'=> $phone,
            'phoneshow' => $phoneshow,
            'autobiography' => $autobiography,
            'usercategory' => $usercategory,
            'image' => $imgpath,
            'positionshow' => $positionshow,
            'employershow'=> $employershow  
            );

            $this->db->where('userid', $userid);
            $this->db->update('user', $data);
        }

        function insertwork($userid,$position,$employer){  
            $this->db->insert("userwork",   
            Array(  
            "userid" =>  $userid,  
            "position" => $position,
            "employer" => $employer
        ));  
        }

        function insertstudentid($userid,$userstudentid){  
            $this->db->insert("userstudentid",   
            Array(  
            "userid" =>  $userid,  
            "studentid" => $userstudentid
        ));  
        } 

        function updateCurrentwork($userid,$currentposition,$currentemployer,$currentstate){
            $data = array(
                'position' => $currentposition,
                'employer' => $currentemployer
            );
            $this->db->where('userid', $userid);
            $this->db->where('state', $currentstate);
            $this->db->update('userwork', $data);
        }

        function addfollow($userid,$key){
            $this->db->select("*");
            $this->db->from("key");
            $this->db->where("tag",$key);
            $query=$this->db->get(); 


            $query2 = $this->db->get_where('follow', array('userid' => $userid, 'followid' => $query->row()->tagid ));
            
            if($query2->num_rows() < 1){    // check if the user add a tag that has been added before
                if($query->num_rows() <= 0){            
                    $this->db->insert("key", 
                        Array(
                        "tag" => $key
                    )); 
                    $tagid=$this->db->insert_id();
                    $this->db->insert("follow", 
                    Array(
                    "userid" => $userid,
                    "followid" => $tagid
                    )); 
                } else{
                    $data = array(
                    'frequency' => $query->row()->frequency + 1
                    );
                
                    $this->db->where("tagid",$query->row()->tagid);
                    $this->db->update("key",$data);
                    $tagid=$query->row()->tagid;
                    $this->db->insert("follow", 
                    Array(
                    "userid" => $userid,
                    "followid" => $tagid
                    )); 
                }
                return $tagid;
            }
            return null;
        }
        function deletefollow($userid,$followid){
            $this->db->select("key.*");  
            $this->db->from('follow');  
            $this->db->join('key', 'follow.followid = key.tagid');  
            $this->db->where("followid",$followid);  
            $queries = $this->db->get();
            
            foreach ($queries->result() as $query ) {
                $frequency=$query->frequency - 1;
            
                if($frequency <= 0){
                    $this->db->where('tagid', $query->tagid);
                    $this->db->delete('key');
                } else{
                    $data = Array(
                    "frequency" => $frequency,
                    );
                    
                    $this->db->where("tagid", $query->tagid);
                    $this->db->update("key", $data);
                }
            }
           
            
            $this->db->where('userid', $userid);
            $this->db->where('followid', $followid);
            $this->db->delete('follow');

        }

        function getpostingevent($userid){
            /*SELECT postingevent.issueid, timestamp, authorid, title
            FROM `postingevent`
            LEFT JOIN `issue` ON issue.issueid = postingevent.issueid
            WHERE notifiedid =1
            ORDER BY timestamp DESC*/
            $this->db->select("postingevent.issueid, timestamp, authorid, title");  
            $this->db->from('postingevent');  
            $this->db->join('issue', 'postingevent.issueid = issue.issueid','left');  
            $this->db->where("notifiedid",$userid);  
            $this->db->where("seen",0);  
            $this->db->order_by("timestamp", "desc"); 
            $query = $this->db->get();

            return $query->result();
        }

        function getreplyevent($userid){
            /*SELECT reply.issueid, reply.userid, reply.timestamp, title
            FROM `replyevent`
            LEFT JOIN `reply` ON reply.replyid = replyevent.replyid
            LEFT JOIN `issue` ON issue.issueid = reply.issueid
            WHERE notifiedid =1
            AND seen =0
            ORDER BY reply.timestamp DESC*/
            $this->db->select("replyevent.replyid,reply.issueid, reply.userid, reply.timestamp,authorid, title");  
            $this->db->from('replyevent');  
            $this->db->join('reply', 'reply.replyid = replyevent.replyid','left');
            $this->db->join('issue', 'issue.issueid = reply.issueid','left');  
            $this->db->where("notifiedid",$userid);  
            $this->db->where("seen",0);  
            $this->db->order_by("reply.timestamp", "desc"); 
            $query = $this->db->get();

            return $query->result();
        }
        function updatepostseen($userid,$issueid){
            $data = array(
                'seen' => 1
            );
            $this->db->where('notifiedid', $userid);
            $this->db->where('issueid', $issueid);
            $this->db->update('postingevent', $data);
        }
        function updatereplyseen($userid,$replyid){
            $data = array(
                'seen' => 1
            );
            $this->db->where('notifiedid', $userid);
            $this->db->where('replyid', $replyid);
            $this->db->update('replyevent', $data);
        }
    }  