<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
      
    class Issue extends MY_Controller { 
		public function post(){
			/* Check whether the user login or not*/
			if (!isset($_SESSION["user"])){
				redirect(site_url("/user/login"));	// Redirect to the login page
				return true;
			}  //end if
		
			$this->load->view('postissue',
			Array(
			"pageTitle" => "Post Issue"
			));
		}
		
		public function posting(){
			/* Check whether the user login or not*/
			if (!isset($_SESSION["user"])){
				redirect(site_url("/user/login"));	// Redirect to the login page
				return true;
			} 
	 
			$title = trim($this->input->post("title"));
			$content= trim($this->input->post("content"));
			$tag = trim($this->input->post("tag"));
			
			if( $title =="" || $content =="" ){
				$this->load->view('postissue',Array(
					"pageTitle" => "Post Issue",
					"errorMessage" => "Title or Content shouldn't be empty,please check!" ,
					"title" => $title,
					"content" => $content
				));
				return false;
			}
	 
			$this->load->model("issuemodel");
			$issueID = $this->issuemodel->insert($_SESSION["user"]->userid,$title,$content);  //完成新增動作
			$tagid=$this->issuemodel->addtag($issueID,$tag);
			$this->issuemodel->follow($_SESSION["user"]->userid,$tagid);
			redirect(site_url("issue/view/".$issueID));
		}	
		
    	public function view($issueID = null){  
			if($issueID == null){
			show_404("Issue not found !");
			return true;
			}
 
			$this->load->model("issuemodel");

			//完成取資料動作
			$issue = $this->issuemodel->getIssue($issueID);  
			$this->issuemodel->updateViews($issueID, $issue->views);

	 
			if($issue == null){
				show_404("Issue not found !");
				return true;	
			}
	 
			$this->load->view('issueview',Array(
				"pageTitle" => $issue->title, 
				"issue" => $issue
				
			));
        }
		
		public function edit($issueID){
			$this->load->model("issuemodel");
			$issue=$this->issuemodel->getIssue($issueID);
			
			$this->load->view('editissue',
			Array(
			"pageTitle" => "Edit Issue",
			"issue" => $issue,
			));
		}
		
		public function editing($issueID){
			$content=trim($this->input->post("content"));
			
			$this->load->model("issuemodel");
			$this->issuemodel->editIssue($issueID, $content);		
			$issue=$this->issuemodel->getIssue($issueID);
			
			$this->load->view('issueview',Array(
				"pageTitle" => $issue->title, 
				"issue" => $issue
				
			));
		}
		
		public function delete($issueID){
			$this->load->model("issuemodel");
			$this->issuemodel->deleteIssue($issueID);
			$issues=$this->issuemodel->getALlIssues();
			
			$this->load->view('issuetable',
			Array(
			"pageTitle" => "Total Issues List",
			"issues" => $issues
			));
		}
		
		public function issuelist(){
			/* Check whether the user login or not*/
			if (!isset($_SESSION["user"])){
				redirect(site_url("/user/login"));	// Redirect to the login page
				return true;
			}  //end if
		
			$this->load->model("issuemodel");
			$issues=$this->issuemodel->getAllIssues();
			
			$this->load->view('issuetable',
			Array(
			"pageTitle" => "Total Issues List",
			"issues" => $issues
			));
		}
    } 
