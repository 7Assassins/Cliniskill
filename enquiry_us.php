<?php
$to = "prudvi.svapps@gmail.com";
			$from= $data['email'];
			$subject ="User Appointment Mail";
			$body = "<p><i><b>
					 This mail is from Raghavendra Pradeep Urology regarding User Contact Information.</b><br>
					 Firstname : ".$data['fname']."<br>
                     Lastname : ".$data['lname']."<br>
					 Mobile : ".$data['mobile']."<br>
					 Email : ".$data['email']."<br>
					 Message : ".$data['message']."<br>
                     Area of Interest : ".$data['area']."<br>
                     Mode of Learning : ".$data['learning']."<br>
                     Timing : ".$data['timing']."<br>
			         </i></p>";
	        $body = preg_replace('/\\\\/','', $body); //Strip backslashes
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			$headers .= "From: ".$_POST['email'] . "\r\n" .
			"Reply-To: prudvi.svapps@gmail.com" . "\r\n" .
			"X-Mailer: PHP/" . phpversion();
			$mail= mail($to,$subject,$body,$headers);
			echo "<script>alert('Thank You For Contacting Us..!!');window.location='enquiry.html';</script>";
?>