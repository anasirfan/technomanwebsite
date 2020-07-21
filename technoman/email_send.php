<?php
require 'PHPMailer/PHPMailerAutoload.php';
try {
	if(isset($_POST['email_send'])) {
		$mail = new PHPMailer;
		$mail->FromName   = $_POST['name'];
		$to_email  = "info@technoman.biz";
		$mail->AddAddress($to_email);
		$mail->From      	 = $_POST['email'];	
		$mail->Subject  = "Technoman";
		$body = "<table>
			 <tr>
				<th colspan='2'>Technoman</th>
			 </tr>
			 <tr>
				<td>Name :</td>
				<td>".$_POST['name']."</td>
			 </tr>
			 <tr>
			  <td>Phone : </td>
			  <td>".$_POST['phone']."</td>
			</tr>
			 <tr>
			  <td>E-mail : </td>
			  <td>".$_POST['email']."</td>
			</tr>	
			<tr>
			  <td>Task : </td>
			  <td>".$_POST['message']."</td>
			</tr>
			<table>";
		$body = preg_replace('/\\\\/','', $body);
		$mail->MsgHTML($body);		
		$mail->IsSendmail();
		$mail->AddReplyTo("info@technoman.biz");
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; 
		$mail->WordWrap   = 80; 
		$mail->AddAttachment($_FILES['attach']['tmp_name'], $_FILES['attach']['name']);
		$mail->IsHTML(true);
		$mail->Send();
		echo 'The message has been sent.';
	}
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>