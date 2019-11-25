<?php

	class Email_model extends Ci_model

	{
		function __construct()		{
			parent::__construct();
		}
		public function myMailSender($mailData){
			$result = array();
			$result['success'] = false;
			$result['error'] = false;
			$mail = new PHPMailer\PHPMailer\PHPMailer; 
			try {
			    //$mail->SMTPDebug = 2; // Enable verbose debug output
			    $mail->isSMTP(); // Set mailer to use SMTP
			    $mail->Host = 'localhost';  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = false; // Enable SMTP authentication			    
			    $mail->SMTPAutoTLS = false;
			    //$mail->Username = 'system@tormami.com'; // SMTP username
			    //$mail->Password = '%l+bj%ubFqpE'; // SMTP password
			    $mail->SMTPSecure = false; // Enable TLS encryption, `ssl` also accepted
			    //$mail->Port = 465; // TCP port to connect to
			    $mail->isHTML(true);
			    //Recipients
			    $mail->setFrom($mailData['from'], $mailData['sender_name']);//$mailData['from']
			    $mail->addAddress($mailData['to'], $mailData['receiver_name']); 
			    if(!is_null($mailData['reply_to'])){
			    	$mail->addReplyTo($mailData['reply_to'], $mailData['from_name']);
			    }
			    //$mail->addCC('cc@example.com');
			    //$mail->addBCC('bcc@example.com');
			    //Attachments
			    if(!is_null($mailData['file'])){
			    	 $mail->addAttachment($mailData['file'], $mailData['file_name']); // Optional name
			    }
			    $mail->isHTML(true); // Set email format to HTML
			    $mail->Subject = $mailData['subject'];
			    $mail->Body    = $mailData['body'];
			    $mail->send();
			    $result['success'] = true;//'Message has been sent';
			} catch (Exception $e) {
			    $result['error'] = $mail->ErrorInfo; //'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
			}
			return $result;
		}

	}



?>