<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
      
    class User extends MY_Controller {  
        public function register()  {  
            $this->load->view('register',Array(   
            "pageTitle" => "Sign up"
            )); 
        }  //end register
      
        public function registering(){  
            $account = $this->input->post("account");  
            $account = htmlspecialchars($account);
            $password= $this->input->post("password");  
            $passwordrt= $this->input->post("passwordrt");  
          
            if( trim($password) =="" || trim($account) =="" ){  
                $this->load->view('register',Array(  
                "errorMessage" => "Account or Password shouldn't be empty,please check!" ,  
                "account" => $account  
                ));  
                return false;  
            } //end if 
      
      
            $this->load->model("UserModel");  
            if($this->UserModel->checkUserExist(trim($account))){ //檢查帳號是否重複  
                $this->load->view('register',Array(  
                "errorMessage" => "This account is already in used." ,  
                "account" => $account  
                ));  
                return false;  
            }//end if

            $this->UserModel->insert(trim($account),trim($password)); //完成新增動作  
            $this->load->view('login',Array(  
            "UserID" => $account  ,
            "pageTitle" => "Sign up successfully! Login.",
            "Regist" => true
            )); 
        }  //end registering

        public function login(){  
            if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ //已經登入的話直接回首頁  
            redirect(site_url("/")); //轉回首頁  
            return true;  
            }  

            $this->load->view('login',Array(  
            "pageTitle" => "Login"
            ));  
        }  //end login

        public function logining(){
            if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ //已經登入的話直接回首頁
                redirect(site_url("/")); //轉回首頁
                return true;
            }
 
            $account = trim($this->input->post("UserID"));
            $password = trim($this->input->post("password"));
 
            $this->load->model("UserModel");
            $user = $this->UserModel->getUser($account,$password);
 
            if($user == null){
                $this->load->view(
                "login",
                Array( "pageTitle" => "Logining" ,
                "UserID" => $account,
                "errorMessage" => "ID or password wrong"
                ));  
                return true;
            }

            $_SESSION["user"] = $user;
            redirect(site_url("/")); //轉回首頁
        }//end logining
 
        public function logout(){
            session_destroy();
            redirect(site_url("/")); //轉回
        }//end logout

        public function edit(){
            if (!isset($_SESSION["user"])){//尚未登入時轉到登入頁  
                redirect(site_url("/user/login")); //轉回登入頁  
                return true;  
            }  //end if
            $account = $_SESSION["user"]->userid;

            $this->load->model("UserModel");
            //完成取資料動作
            $userfile = $this->UserModel->getUserfile($account); 
            $userwork = $this->UserModel->getUserwork($account); 
            $userstudentid = $this->UserModel->getUserstudentid($account); 

            $this->load->view('useredit',Array(  
            "pageTitle" => "Edit profile",
            "userwork" => $userwork,
            "userstudentid" => $userstudentid,
            "userfile" => $userfile
            ));  
        }

        public function editing(){
            if (!isset($_SESSION["user"])){//尚未登入時轉到登入頁  
                redirect(site_url("/user/login")); //轉回登入頁  
                return true;  
            }  
            $userid = trim($this->input->post("userid"));
            if ($userid != $_SESSION["user"]->UserID ){  
                show_404("User not authenticated !");  
                //不是作者又想編輯，顯然是來亂的，送他回首頁。  
                redirect(site_url("/"));   
                return true;  
            }  

            //edit implement
/*inputpost=> file, and  "email","phone","address","phoneshow","addressshow","autobiography","usercategory","position","employer","positionshow","employershow","studentid"  */
            $email = trim($this->input->post("email"));
            $address = trim($this->input->post("address"));
            $phone = trim($this->input->post("phone"));
            $addressshow = trim($this->input->post("addressshow"));
            $phoneshow = trim($this->input->post("phoneshow"));
            $autobiography = trim($this->input->post("autobiography"));   
            $usercategory = trim($this->input->post("usercategory"));
            $position = trim($this->input->post("position"));   
            $employer = trim($this->input->post("employer"));
            $studentid = trim($this->input->post("studentid"));   

            //implement img upload
            $config['upload_path'] = '/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2000';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload',$config);

            if ( ! $this->upload->do_upload()){
                $error = array('error' => $this->upload->display_errors());
            }
            else{
                $imgdata = array('upload_data' => $this->upload->data());
                $imgpath = $img_data['file_name'];            
            }//end img part  insert imgpath to DB

/*$img_data = array , keyname=attributes have 'file_name'  file_type is_image image_width image_heigth image_type   using as $img_data['filename'] 
reference: http://www.codeigniter.org.tw/user_guide/libraries/file_uploading.html
*/
            $this->load->model("UserModel");
            //完成取資料動作
            $this->UserModel->updateUser($userid,$email,$address,$phone,$addressshow,$phoneshow,$autobiography,$usercategory,$imgpath); 
            $this->UserModel->insertwork($userid,$position,$employer,$positionshow,$employershow);
            $this->UserModel->insertstudentid($userid,$studentid);

            $this->load->view('userfile',Array(  
            "pageTitle" => "Userifle"
            ));   //轉回file頁面
        }//end logining


	public function profile(){
        	if (!isset($_SESSION["user"])){//尚未登入時轉到登入頁
        		redirect(site_url("/user/login")); //轉回登入頁
        		return true;

        	}
        	$account = $_SESSION["user"]->userid;
        	//id should load from total view
        	$id = trim($this->input->get("userID"));
        	
        	if ( $id == $account ){
        		$this->edit();
        	}//check whether this user is the user himself or not
        	else {

        		$this->load->model("UserModel");
        		//完成取資料動作
        		$userfile = $this->UserModel->getUserfile($id);
        		$userwork = $this->UserModel->getUserwork($id);
        		$userstudentid = $this->UserModel->getUserstudentid($id);
        		 
        		$this->load->view('profile',Array(
        				"userwork" => $userwork,
        				"userstudentid" => $userstudentid,
        				"userfile" => $userfile,
        				"account" => $account
        		));
        	}
        }

    }  

