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
            $userid = trim($this->input->post("fileuserid"));
            if ($userid != $_SESSION["user"]->userid ){  
                show_404("User not authenticated !");  
                //不是作者又想編輯，顯然是來亂的，送他回首頁。  
                redirect(site_url("/"));   
                return true;  
            }  

            //edit implement
/*inputpost=> file, 
and  "email","phone","address","phoneshow","addressshow","autobiography","usercategory","position","employer","positionshow","employershow","studentid","addid","addwork","imgpath"
"currentposition" ,"currentemployer","currentstate","currentoldposition","currentoldemployer"*/
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
            $positionshow = trim($this->input->post("positionshow"));   
            $employershow= trim($this->input->post("employershow"));   
            $addwork = trim($this->input->post("addwork"));   
            $addid= trim($this->input->post("addid"));   
            $imgpath= trim($this->input->post("imgpath"));  
            $currentposition= trim($this->input->post("currentposition"));  
            $currentemployer= trim($this->input->post("currentemployer")); 
            $currentstate= trim($this->input->post("currentstate"));  
            $currentoldposition= trim($this->input->post("currentoldposition"));  
            $currentoldemployer= trim($this->input->post("currentoldemployer")); 


            //implement img upload
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload',$config);

            if ( ! $this->upload->do_upload()){
                $error =  $this->upload->display_errors();
                if($error =="<p>You did not select a file to upload.</p>"){
                    $error= null;
                }
            }
            else{
                $imgdata = $this->upload->data();
                $imgpath = $imgdata['file_name'];            
            }//end img part  insert imgpath to DB

/*$img_data = array , keyname=attributes have 'file_name'  file_type is_image image_width image_heigth image_type   using as $img_data['filename'] 
reference: http://www.codeigniter.org.tw/user_guide/libraries/file_uploading.html
*/
            $this->load->model("UserModel");
            //完成取資料動作
            $this->UserModel->updateUser($userid,$email,$address,$phone,$addressshow,$phoneshow,$autobiography,$usercategory,$imgpath,$positionshow,$employershow); 
            if($addwork==1 && $position!=""){
                $this->UserModel->insertwork($userid,$position,$employer);
            }
            if($addid==1 && $studentid!=""){
                $this->UserModel->insertstudentid($userid,$studentid);
            }
            if($currentemployer!="" || $currentposition!=""){
                if($currentemployer!=$currentoldemployer || $currentposition!=$currentoldposition){
                    $this->UserModel->updateCurrentwork($userid,$currentposition,$currentemployer,$currentstate);
                }
            }
            
            $userfile = $this->UserModel->getUserfile($userid); 
            $userwork = $this->UserModel->getUserwork($userid); 
            $userstudentid = $this->UserModel->getUserstudentid($userid); 

            //取得此使用者的發文紀錄
            $this->load->model("IssueModel");
            $userpost = $this->IssueModel->getUserIssues($userid);

            $this->load->view('profile',Array(  
            "pageTitle" => "Userifle",
            "userwork" => $userwork,
            "userstudentid" => $userstudentid,
            "userfile" => $userfile,
            "account" => $userid,
            "issues" => $userpost,
            "error" => $error
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
        		 

                //取得此使用者的發文紀錄
                $this->load->model("IssueModel");
                $userpost = $this->IssueModel->getUserIssues($id);

        		$this->load->view('profile',Array(
        				"userwork" => $userwork,
        				"userstudentid" => $userstudentid,
        				"userfile" => $userfile,
        				"account" => $account,
                        "issues" => $userpost
        		));
        	}
        }
        // 處理Search ajax的funtcion （from table.php）
        public function search(){
            //接參數 用來搜尋user 的name or id
            $queryTerm = trim($this->input->post("queryTerm"));
            $resultArray =  array('');
            //引入要用的model
            $this->load->model('listmodel');
            $this->load->model('usermodel');
            //先撈出所有的user list 準備做name的比對
            $dataArray = $this->listmodel->getUsersFromName();
            //echo html的格式 是為了 回傳結果給前台直接改變頁面用的
            echo "<thead>";
            echo "<tr>";
            echo "<td>Name</td>" ; 
            echo "<td>StudentID</td>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($dataArray as $key => $value) {
                $tempText = "";
                $studentidArray = $this->usermodel->getUserstudentid($value->userid);
                foreach ($studentidArray as $key2 => $studentid)
                    {
                        if( $key2 > 0  ){
                            $tempText = $tempText . ",";
                        }
                        $tempText = $tempText . $studentid->studentid;

                       // echo print_r($studentid);
                    }
                $tempArray = array("username"=>$value->username,"userid"=>$value->userid,"studentid"=>$tempText);
                array_push($resultArray, $tempArray); 
            }



            //開始比對資料的foreach迴圈
            foreach ($resultArray as $key => $value) {
                //判斷從資料庫拿出來的資料 是不是跟query相同
                //echo print_r($value);
                if( (strchr($value["username"],$queryTerm)!=false )|| (strchr($value["studentid"],$queryTerm)!=false)){
                    //相同的時候開始做的事情 同樣的echo html的地方是為了前台座的處理
                    // $studentidArray = $this->usermodel->getUserstudentid($value->userid);
                    $text = "<tr class='tr_hover' em ='".$value["userid"]."'>";
                    echo $text ;
                    echo "<td>";
                    echo $value["username"];
                    echo "</td>";
                    echo "<td>";
                    echo $value["studentid"];
                    //這邊是為了當名字一樣的時候撈出他的student id
                    // foreach ($studentidArray as $key2 => $studentid)
                    // {
                        // if( $key2 > 0  ){
                            // echo ",";
                        // }
                        // echo $studentid->studentid;

                       // echo print_r($studentid);
                    // }
                    echo "</td>";
                    echo "</tr>";
                }

            }
           echo "</tbody>";
        }

    }  
?>
