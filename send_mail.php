<?php

//echo '<div class="response" id="success-response">Enviando...</div>';


	$name = trim($_POST['name']);
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$comments = $_POST['comments'];
	
	$site_owners_email = "info@area51.pe"; // Replace this with your own email address
	$site_owners_name = "Area51 Training Center"; // replace with your name
	
	if (strlen($name) < 2) {
		$error['name'] = "Por favor ingresa tu nombre";	
	}
	
	if (strlen($phone) < 9) {
			//$error['phone'] = "Por favor ingresa tu teléfono";	
	}
	
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Por favor ingresa tu email";	
	}
	
	if (strlen($comments) < 3) {
		$error['comments'] = "Por favor deja tu mensaje";
	}
	
	if (!$error) {
		
		require_once('phpMailer/class.phpmailer.php');
		/*
		$mail = new PHPMailer();
		
		$mail->From = "info@area51.pe";
		$mail->FromName = $site_owners_name;
		$mail->Subject = "Formulario Area51";
		$mail->AddAddress($site_owners_email, $site_owners_name);
		$mail->AddReplyTo($email,$name);

		$mail->AltBody = "Nombre: ".$name."\nEmail: ".$email."\nTelefono: ".$phone."\nMensaje: ".$comments."\n";		
		*/
		$body = "<table width=\"640\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\" style=\"font-family:Arial, Helvetica, sans-serif;\">
  <tr>
    <td width=\"130\"><img src=\"http://area51.pe/images/logo_area51.gif\" width=\"199\" height=\"91\"></td>
    <td width=\"510\" style=\"font-size:24px; font-weight:bold; color:#666\">Formulario de Contacto</td>
  </tr>
  <tr>
    <td colspan=\"2\"><table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\" style=\"font-size:12px\">
      <tr>
        <td colspan=\"2\" height=\"22\"><hr color=\"#003300\" /></td>
        </tr>
      <tr>
        <td width=\"100\" valign=\"top\"><strong>Nombre</strong></td>
        <td valign=\"top\" style=\"border-bottom:1px solid #ccc\">".$name."</td>
      </tr>
      <tr>
        <td valign=\"top\"><strong>Email</strong></td>
        <td valign=\"top\" style=\"border-bottom:1px solid #ccc\">".$email."</td>
      </tr>
      <tr>
        <td valign=\"top\"><strong>Telefono</strong></td>
        <td valign=\"top\" style=\"border-bottom:1px solid #ccc\">".$phone."</td>
      </tr>
      <tr>
        <td valign=\"top\"><strong>Mensaje</strong></td>
        <td valign=\"top\" style=\"border-bottom:1px solid #ccc\">".$comments."</td>
      </tr>
    </table></td>
  </tr>
</table>";
		
		

		/*
		
		$mail->MsgHTML($body);
		
		// MAIL STUFF
		
		$mail->Mailer = "smtp";
		$mail->Host = 'ssl://smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPSecure = "ssl"; 
		
		
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->Username = "info@area51.pe"; // SMTP username
		$mail->Password = "35##area"; // SMTP password
		
		
		$mail->Send();
		echo $mail->ErrorInfo;
		echo '<div class="response" id="success-response">Gracias ' . $name . ', estamos en contacto. </div>';
		*/


/*
$name = trim($_POST['name']);
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$comments = $_POST['comments'];
	
	$site_owners_email = "info@area51.pe"; // Replace this with your own email address
	$site_owners_name = "Area51 Training Center"; // replace with your name

	*/

$to      = 'info@area51.pe';
$subject = 'Mensaje desde Area51.pe';
$message = $body;



$headers = 'From: '.$email . "\r\n" .
    'Reply-To: '.$email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


mail($to, $subject, $message, $headers);


echo '<div class="response" id="success-response">Gracias ' . $name . ' por escribir,<br> pronto nos comunicaremos contigo. </div>';
		
		
	} # end if no error
	else {
		
		

		$response = "<div class='response' id='error-response'><ul>";
		$response .= (isset($error['name'])) ? "<li>" . $error['name'] . "</li> \n" : null;
		$response .= (isset($error['email'])) ? "<li>" . $error['email'] . "</li> \n" : null;
		
		$response .= (isset($error['phone'])) ? "<li>" . $error['phone'] . "</li> \n" : null;
		
		$response .= (isset($error['comments'])) ? "<li>" . $error['comments'] . "</li>" : null;
		$response .= "</ul>";
		
		echo $response;
	} # end if there was an error sending

?>