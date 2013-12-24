<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
      
    class Issue extends MY_Controller { 
		public function post(){
			/* Check whether the user login or not*/
			if (!isset($_SESSION["user"])){
				$this->load->view('singlesignon',Array(   
				"pageTitle" => "Sign in"
				)); 
			}  //end if
		
			$this->load->view('postissue',
			Array(
			"pageTitle" => "Post Issue"
			));
		}
		
		public function posting(){
			/* Check whether the user login or not*/
			if (!isset($_SESSION["user"])){
				$this->load->view('singlesignon',Array(   
				"pageTitle" => "Sign in"
				)); 
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
			//tag processing
			$tag= preg_replace('/( *)/', '', $tag);
			$stringarray=explode ("#",$tag);
			foreach($stringarray as $split){
				if($split != ""){
					$tagid=$this->issuemodel->addtag($issueID,$split);
				}
			}

			$this->issuemodel->follow($_SESSION["user"]->userid,$tagid);
			$this->postingevent($issueID,$_SESSION["user"]->userid);
			redirect(site_url("issue/view/".$issueID));
		}	
		
    	public function view($issueID = null){  
			if($issueID == null){
				show_404("Issue not found !");
				return true;
			}
 

 			$this->load->model("IssueModel");  
	    	// $issueID = $this->input->get("id");
	    	$issueContent = $this->IssueModel->getIssueContent($issueID);

	    	if($issueContent == null){
				show_404("Issue not found !");
				return true;	
			}

	    	$replyList = $this->IssueModel->getReplyList($issueID);
	    	$author = $this->IssueModel->getIssueAuthor($issueContent->authorid);
	    	$tagArray = $this->IssueModel->getTagArray($issueID);
	    	$this->IssueModel->updateViews($issueID);
	    	$authorName = array();
	    	foreach ($replyList as $reply) { 
	    		$authorName[$reply->userid] = $this->IssueModel->getIssueAuthor($reply->userid);
	    	}

	    	$this->load->view('issue_content', Array(
	    		"pageTitle" => "issue_content",
	    		"issue" => $issueContent,
	    		"replyList" => $replyList,
	    		"author" => $author,
	    		"authorName" => $authorName,
	    		"tagArray" => $tagArray
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
				$this->load->view('singlesignon',Array(   
				"pageTitle" => "Sign in"
				)); 
			}  //end if
		
			$this->load->model("issuemodel");
			$issues=$this->issuemodel->getAllIssues();
			
			$this->load->view('issuetable',
			Array(
			"pageTitle" => "Total Issues List",
			"issues" => $issues
			));
		}


	    public function submit_reply(){
	    	echo "<div class='comment col-md-offset-2 col-md-9'>";
			echo "	<hr />";
			echo "	<p>";
			echo $this->input->post("content");
			echo "	</p>";
			echo "	<h5 class='text-right'>" . $this->input->post("name") . "&nbsp&nbsp<small>now</small></h5> ";
			echo "</div>";

			$this->load->model("IssueModel");
			$issueID = $this->input->post("issue_id");
			$content = trim($this->input->post("content"));
			$name = $this->input->post("name");
			$replyid=$this->IssueModel->insertReply($issueID, $content, $name);
			$url=site_url("issue/view/".$issueID);
			$title = $this->IssueModel->getIssueTitle($issueID);
			$subject = 'SDM Reply Notification';

			$notifylist = $this->IssueModel->getReplyerList($issueID);

			foreach ($notifylist as $notify) { 
				//save replyevent
	    		$notifyid = $notify->userid;
	    		$this->IssueModel->insertReplyevent($replyid,$notifyid);
	    		$emailmessage='Hi,'.$notify->username.'.'. $name.'just replied in {unwrap}<a href='.$url.'> '.$title.' </a>{/unwrap}';
	    		//call mail function
				$this->MailAdapter($emailmessage,$notify->email,$subject);
	    	}
	    }
	    public function search(){
	    	/* Check whether the user login or not*/
			if (!isset($_SESSION["user"])){
				$this->load->view('singlesignon',Array(   
				"pageTitle" => "Sign in"
				)); 
			}  //end if

	    	$queryTerm = $this->input->post("queryTerm");
	    	$this->load->model("issuemodel");
			$issues=$this->issuemodel->getAllIssues();
			$resultArray = array();

            foreach ($issues as $key => $value) {
            	$tag = $this->issuemodel->getTagArray($value->issueid);
            	
                if( (strchr($value->title,$queryTerm)!=false) ){

                	array_push($resultArray, $value);
                }
              //   else{
              //   	foreach ($tag as $key2 => $value2) {
            		// 	if( (strchr($value2->tag,$queryTerm)!=false) ){
			           //      	array_push($resultArray, $value);
			           //      }
	            	// }
              //   }
            }
			$this->load->view('issuesearch',
			Array(
			"pageTitle" => "Search Issues List",
			"issues" => $resultArray
			));

	    }



	    private function postingevent($issueid,$author){
	    	$this->load->model("IssueModel");
	    	$title = $this->IssueModel->getIssueTitle($issueid);
	    	$followerlist=$this->IssueModel->getFollowerList($issueid);
	    	$subject = 'SDM Following Posting Notification';
	    	$url=site_url("issue/view/".$issueid);
	    	//print_r($followerlist);
	    	foreach ($followerlist as $notify) { 
				//save postingevent
				if($notify->userid!=""){
		    		$notifyid = $notify->userid;
		    		$this->IssueModel->insertPostingevent($issueid,$notifyid);
		    		$emailmessage='Hi,'.$notify->username.'.'. $author.'just posted a issue which you would like, {unwrap}<a href='.$url.'> '.$title.' </a>{/unwrap}';
		    		//call mail function
					$this->MailAdapter($emailmessage,$notify->email,$subject);
				}
	    	}

	    }

    } 
?>