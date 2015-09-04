<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ApproveNowEmail {
    function EmailSend($toAddress,$subject,$body)
    {
	$CI =& get_instance();
	$config = Array(
			'protocol' => 'smtp',
			//'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'ppkk036@gmail.com',
			'smtp_pass' => '12619892233'
			);
	$CI->load->library('email', $config);
	$CI->email->from('ppkk036@gmail.com', 'ApproveNow Admin');
	$CI->email->set_newline("\r\n");
	$CI->email->to($toAddress);
	$CI->email->subject($subject); 
	$CI->email->message($body);
	if (!$CI->email->send())
	{
	    return $CI->email->print_debugger();
	}
	else
	{
	    return true;
	}
    }
 		
	
 
}
?>