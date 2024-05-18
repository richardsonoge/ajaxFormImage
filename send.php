<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// This script sends an email to your email address from the contact form. Change the variable below to your own email address:
$my_email = 'my_lovely_horse@domain.co.uk';

// Checks email address is a valid one (as far as possible - it basically checks for user errors)
function validateEmail($email){
    
    if (!preg_match("#^[A-Za-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
        return false;
    } else {
        return true;
    }
    
}

// Use validateEmail function above
if(validateEmail($_POST['email'])){
    // Sanitise data
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = $_POST['email'];
    $url = htmlspecialchars($_POST['website']);
    $message = htmlspecialchars($_POST['message']);
    
    if($_POST['phone'] == '' || $_POST['phone'] == null){
        $phone = '--None--';
    } else {
        $phone = htmlspecialchars($_POST['phone']);
    }

    // Check if an image is uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_type = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];

        // Process the uploaded image as needed, for example, move it to a directory
        $upload_dir = 'uploads/';

        // Check if the directory exists, if not, create it
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $target_file = $upload_dir . basename($file_name);

        if(move_uploaded_file($file_tmp_name, $target_file)) {
            // Image uploaded successfully
            $image_url = $target_file;
        } else {
            // Error uploading image
            $image_url = "No image uploaded.";
        }
    } else {
        // No image uploaded
        $image_url = "No image uploaded.";
    }

    $content = "<p>Hey hey,</p>
        <p>You have received an email from $first_name via the website's 'Contact Us' form. Here's the message:</p>
        <p>$message</p>
        <p>
            From: $first_name $last_name
            <br />
            Phone: $phone
            <br />
            Email: $email
            <br />
            Website: $url
            <br />
            Image URL: $image_url
        </p>";

    $try = mail($my_email,"$last_name has emailed via the website",$content,"Content-Type: text/html;");

    // If there was an error sending the email (PHP can use 'sendmail' on GNU/Linux, the easiest way - but do check your spam folder)
    if(!$try){
        $result = '<p>There was an error when trying to send your email. Please try again.</p>';
    } else {
        // echo out some response text (to go in <div id="reponse"></div>)
        $result = '<p>Thank you ' . $first_name . '. We will reply to you at <em>' . $email . '</em> or via your phone number on <em>' . $phone . '</em></p>';
    }

// If the email address does not pass the validation
} else {
    $result = '<p>There was an error with the email address you entered. Please try again.</p>';
}

echo json_encode($result);
?>