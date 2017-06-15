<?php
	
	if(($_POST["contact_name"])&&($_POST["contact_message"])&&($_POST["contact_email"])) { 
	
		$email_subject = 'You have a new message from Facebook';
		$email_body    = 'From: <b>' . $_POST["contact_name"] . '</b><br /><hr /><br /><p>' . $_POST["contact_message"] . '</p>';
		$email_headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$email_headers .= 'From: '. $_POST["contact_email"] . " \r\n"; 
		
		mail('support@fbmaxed.com', $email_subject, $email_body, $email_headers);
	
	} 
	

?>
