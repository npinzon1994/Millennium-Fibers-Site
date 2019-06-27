<?php
$email = $_REQUEST['email'];
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
    'secret' => '6LeYDqsUAAAAAF8CdJmrSeg8RuGtUglD5wTuN3rC',
    'response' => $_POST["g-recaptcha-response"]
);
$options = array(
    'http' => array (
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success=json_decode($verify);

if ($captcha_success->success==false) {
    echo "<script type='text/javascript'> alert('Please click the verification button'); location='../html/contact.html'; </script>";
} else if ($captcha_success->success==true) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL))  {

        //Email information
        $name = $_REQUEST['name'];
        $admin_email = "nick@canaanxpress.com";
        $subject = "Request from " . $email;
        $company = $_REQUEST['company'];
        $phone = $_REQUEST['phone'];
        $message = $_REQUEST['message'];
        $response = $_POST["g-recaptcha-response"];
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $email;
        $final_message = "Dear Millennium Fibers Manager, " . "\r\n\r\n" . $message  . "\r\n\r\nSincerely, " . "\r\n" . $name . "\r\n\r\n" . $phone;

        //send email
        mail($admin_email, "$subject", $final_message, $headers);

        //Email response
        $message_success = "Email sent. Thank you for contacting us!";
        echo "<script type='text/javascript'> alert('$message_success'); location='../html/contact.html'; </script>";
    }

//if "email" variable is not filled out, display the form
    else {
        $message_failed = "Email is invalid. Please use format (name@example.com)";
        echo "<script type='text/javascript'> alert('$message_failed'); location='../html/contact.html'; </script>";
    }
}

?>