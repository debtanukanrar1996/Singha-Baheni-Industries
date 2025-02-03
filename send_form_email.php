<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "singhabaheniindustries@gmail.com";
    $email_subject = "Your email subject line";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['product_code']) ||
		!isset($_POST['Full_name']) ||
        !isset($_POST['email']) ||
		!isset($_POST['mobile']) ||
		!isset($_POST['city']) ||
		!isset($_POST['state']) ||
		!isset($_POST['company']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
    $product_code = $_POST['product_code']; // required
    $Full_name = $_POST['Full_name']; // required
    $email_from = $_POST['email']; // required
	$mobile = $_POST['mobile']; // required
	$city = $_POST['city']; // required
	$state = $_POST['state']; // required
	$company = $_POST['company']; // required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$Full_name)) {
    $error_message .= 'The Full Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$city)) {
    $error_message .= 'The city you entered does not appear to be valid.<br />';
  }
if(!preg_match($string_exp,$state)) {
    $error_message .= 'The state you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$company)) {
    $error_message .= 'The company you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
	$email_message .= "product_code: ".clean_string($product_code)."\n";
    $email_message .= "First Name: ".clean_string($Full_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "mobile: ".clean_string($mobile)."\n";
	$email_message .= "city: ".clean_string($city)."\n";
	$email_message .= "state: ".clean_string($state)."\n";
	$email_message .= "company: ".clean_string($company)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
 
}
?>