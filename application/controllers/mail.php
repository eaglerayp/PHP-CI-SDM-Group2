<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Mail extends MY_Controller {
	function MailAdapter($emailmessage,$email,$subject){
	     $this->MailGmail($emailmessage,$email,$subject);

	}

	function MailGmail($emailmessage,$email,$subject) {
		$ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "b98705002@gmail.com"; 
		$config['smtp_pass'] = "89236256";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

		$ci->email->initialize($config);

		$ci->email->from('b98705002@gmail.com', 'TESTeR');
		$list = array($email);
		$ci->email->to($list);
		$ci->email->subject($subject);
		$ci->email->message($emailmessage);
		$ci->email->send();
	}
}