<?php
$to = "prudvi.svapps@gmail.com";
			$from= $data['email'];
			$subject ="User Appointment Mail";
			$body = "<p><i><b>
					 This mail is from Skill Tech User Contact Information.</b><br>
					 Name : ".$data['name']."<br>
					 Mobile : ".$data['mobile']."<br>
					 Qualification : ".$data['qualification']."<br>
					 Year of Passing : ".$data['year']."<br>
					 Batch : ".$data['batch']."<br>
			         </i></p>";
	        $body = preg_replace('/\\\\/','', $body); //Strip backslashes
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$headers .= "From: ".$_POST['email'] . "\r\n" .
			"Reply-To: prudvi.svapps@gmail.com" . "\r\n" .
			"X-Mailer: PHP/" . phpversion();
			$mail= mail($to,$subject,$body,$headers);
			echo "<script>alert('Thank You For Contacting Us..!!');window.location='payment.html';</script>";
?>