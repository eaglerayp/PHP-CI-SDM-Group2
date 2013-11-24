<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issue extends CI_Controller {
	public function index(){
        $this->load->view('issue_list',Array(  
        "pageTitle" => "issue_list"
        ));  
    }

    public function get_content(){
    	$this->load->model("IssueModel");  
    	$issueID = $this->input->get("id");
    	$issueContent = $this->IssueModel->getIssueContent($issueID);
    	$replyList = $this->IssueModel->getReplyList($issueID);
    	$author = $this->IssueModel->getIssueAuthor($issueContent->authorid);
    	$tagArray = $this->IssueModel->getTagArray($issueID);

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
    		// "test" => $issueContent->content
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

		// $link_ID = mysqli_connect("140.112.106.48", "R02725004", "julia0514", "R02725004") or die('Error with MySQL connection' . mysql_error());
		// mysqli_query($link_ID, "SET CHARACTER SET UTF8;"); 
		// mysqli_query($link_ID, "SET NAMES 'UTF8';"); 

		// $query = "SELECT * FROM `Users` WHERE name=" . $issue["name"];

		// $query = "INSERT INTO `Comments` ( `issue_id`, `content`, `author`) VALUES ( '" . $this->input->post("issue_id") . "', '" . $this->input->post("content") . "', '" . $this->input->post("name") . "' )";
		// $result = mysqli_query($link_ID, $query);
		// mysqli_close($link_ID);
		$this->load->model("IssueModel");
		$this->IssueModel->insertReply($this->input->post("issue_id"), $this->input->post("content"), $this->input->post("name"));

    }
}
