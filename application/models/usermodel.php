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
        public function getUser($account,$password){  
            $this->db->select("userid,username");  
            $query = $this->db->get_where("user",Array("userid" => $account, "password" => $password ));  
      
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
    }  