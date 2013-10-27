<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
      
    class Viewlist extends MY_Controller {  
	
	/* function for table.php */
    public function table(){
    	/* Check whether the user login or not*/
    	if (!isset($_SESSION["user"])){
    		redirect(site_url("/user/login"));	// Redirect to the login page
    		return true;
    	}  //end if
    	
	    $this->load->model('listmodel','',TRUE);
	    $rows = $this->listmodel->getRows();
	    $rawdata = $this->listmodel->getData();
	    
	    /* The for loop is to reorganize the data which will make view php file easier to print. 
	     * Because one person can have more than a studentid 
	     * $senddata is the tansmitted object to test.php */
	    for($i=0; $i<$rows; $i++){
	    	$senddata[$i]->userid = $rawdata[$i]->userid;		// record userid which is used to send to user/profile
	    	$senddata[$i]->username = $rawdata[$i]->username;
	    	$senddata[$i]->studentid = $rawdata[$i]->studentid;
	    	
	    	if(($i+1)<$rows){
	    		/* This is the condition which the person has the second studentid*/
	    		if($rawdata[$i]->username == $rawdata[$i+1]->username){
	    			$senddata[$i]->studentid = $senddata[$i]->studentid.",".$rawdata[$i+1]->studentid;
	    			// append the second studentid to $senddata[$i]->studentid
	    			
					if(($i+2)<$rows){
						/* This is the condition which the person has the third studentid*/
						if($rawdata[$i+1]->username == $rawdata[$i+2]->username){
							$senddata[$i]->studentid = $senddata[$i]->studentid.",".$rawdata[$i+2]->studentid;
							// append the third studentid to $senddata[$i]->studentid
							
							$i++; // avoid to loop to the same username
						}
					}
	    			$i++;	// avoid to loop to the same username
	    		}
	    	}
	    }
	    
	    $data['text'] = $senddata;	// the organized data
	    
	    $this->load->view('table', $data);	// load table.php
	}
        
    }  

