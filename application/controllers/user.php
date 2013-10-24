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
            //edit implement
            //implement img upload
            $config['upload_path'] = '/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';

            $this->load->library('upload',$config);

            if ( ! $this->upload->do_upload()){
                $error = array('error' => $this->upload->display_errors());
            }
            else{
                $imgdata = array('upload_data' => $this->upload->data());
                $imgpath = base_url("/uploads/".$img_data['file_name']);            
            }//end img part  insert imgpath to DB

/*$img_data = array , keyname=attributes have 'file_name'  file_type is_image image_width image_heigth image_type   using as $img_data['filename'] 
reference: http://www.codeigniter.org.tw/user_guide/libraries/file_uploading.html
*/


            $_SESSION["user"] = $user;
            $this->load->view('userfile',Array(  
            "pageTitle" => "Userifle"
            ));   //轉回file頁面
        }//end logining



    }  