# Pure JavaScript AJAX POST Form

## Overview
Here's a form that will help you process any data in your form and submit a single image file in pure javascript without using libraries. I created it with HTML5, CSS, AJAX, PHP, and pure Javascript code using the POST method.

## Requirements
This FORM supports all modern browsers that support HTML5. There may be problems with earlier versions of Internet Explorer (as usual). If so, please let me know, as I don't have Internet Explorer or others. It has been tested on Firefox (Linux), Chrome (Linux), and Safari (iOS 7).

```
Copyright (C) 2024  Richardson Oge, TranslaDocs.com
Licenced under the GNU AFFERO GENERAL PUBLIC LICENSE (v3). See: LICENCE.txt
```

## Get Started
1. Create the FORM `form.html`:

    ```html
    <!DOCTYPE html>
	<html lang="en-GB">
	<head>
	    <meta charset="utf-8">
	    <title>Contact Form</title>
	    <meta name="author" content="Richardson Oge" />
	    <meta name="description" content="This example is a form you can use to process any data and upload a single image file with pure JS code to your form. I've integrated PHP's mail function to send the email to a specified email address, but this may not work, so I suggest you use PHPMailer." />
	    <link rel="stylesheet" href="styles.css">
	</head>

	<body>

	    <header role="banner">
	        <h1>HTML / JavaScript / AJAX / PHP Form</h1>
	        <p>This example is a form you can use to process any data and upload a single image file at the same time with pure JS code in your form and send it to a specified e-mail address.</p>
	    </header>

	    <main role="main">

	        <section>

	            <h2>Your Details</h2>

	            <div id="response"></div>

	            <form name="contact-form" id="contact">

	                <label for="first_name">First Name</label>
	                <input id="first_name" type="text" placeholder="First Name" pattern="[0-9A-Za-z\- ]+" title="Please enter a valid first name." required="required" />

	                <label for="last_name">Last Name</label>
	                <input id="last_name" type="text" placeholder="Last Name" pattern="[A-Za-z\- ]+" title="Please enter a valid surname / family name." required="required" />

	                <label for="email">Email Address</label>
	                <input id="email" type="email" placeholder="Email Address" required="required" />

	                <label for="website">Website (Optional)</label>
	                <input id="website" type="url" placeholder="Website" title="Please enter a valid URL (must begin with 'http://' or 'https://')." />

	                <label for="phone">Telephone Number (Landline or Mobile)</label>
	                <input id="phone" type="tel" placeholder="Telephone Number" />

	                <label for="message">Message</label>
	                <textarea id="message" placeholder="Enter your message here..." form="contact" required="required"></textarea>

	                <label for="image">Upload Image</label>
	                <input id="image" type="file" accept="image/*" />

	                <button type="submit" id="submit-button">Submit</button>
	            </form>

	        </section>

	    </main>
	    <script src="post.js"></script>
	</body>
	</html>
    ```
2. Add CSS code to this `style.css` file:

```css
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Helvetica Neue', Arial, sans-serif;
}

body {
    background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    color: #333;
    padding: 20px;
    font-size: 16px;
}

header {
    background: linear-gradient(135deg, #43cea2, #185a9d);
    color: #fff;
    padding: 40px 0;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
}

header h1 {
    font-size: 2.5em;
    margin-bottom: 10px;
}

header p {
    font-size: 1.2em;
    margin-top: 10px;
}

main {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

section {
    margin: 20px 0;
}

h2 {
    font-size: 1.8em;
    margin-bottom: 10px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    margin-top: 15px;
}

input[type="text"],
input[type="email"],
input[type="url"],
input[type="tel"],
input[type="file"],
textarea {
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1em;
    width: 100%;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="tel"]:focus,
input[type="file"]:focus,
textarea:focus {
    border-color: #43cea2;
}

textarea {
    height: 150px;
}

button {
    background: #43cea2;
    color: #fff;
    border: none;
    padding: 15px;
    font-size: 1.2em;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s ease;
    margin-top: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

button:hover {
    background: #185a9d;
}

#response {
    margin-top: 20px;
    font-size: 1.1em;
    text-align: center;
}

@media (max-width: 600px) {
    header h1 {
        font-size: 2em;
    }

    main {
        padding: 15px;
    }

    button {
        font-size: 1em;
        padding: 12px;
    }
}
```

3. Create the JS file `post.js`:

```js
document.addEventListener("DOMContentLoaded", function(){
    document.forms["contact-form"].addEventListener("submit", postData);
});

function postData(formsubmission){
    formsubmission.preventDefault();

    var submitButton = document.getElementById("submit-button");
    submitButton.disabled = true;
    submitButton.textContent = "Wait";

    var formData = new FormData();
    
    // Add form data
    formData.append("first_name", document.getElementById("first_name").value);
    formData.append("last_name", document.getElementById("last_name").value);
    formData.append("email", document.getElementById("email").value);
    formData.append("website", document.getElementById("website").value);
    formData.append("phone", document.getElementById("phone").value);
    formData.append("message", document.getElementById("message").value);

    // Add image data
    var imageInput = document.getElementById("image");
    if (imageInput.files.length > 0) {
        formData.append("image", imageInput.files[0]);
    }

    // Checks if fields are filled-in or not, returns response "<p>Please enter your details.</p>" if not.
    if(formData.get("first_name") == "" || formData.get("last_name") == "" || formData.get("email") == "" || formData.get("phone") == "" || formData.get("message") == ""){
        document.getElementById("response").innerHTML = "<p>Please enter your details.</p>";
        submitButton.disabled = false;
        submitButton.textContent = "Submit";
        return;
    }

    var http = new XMLHttpRequest();
    http.open("POST", "send.php", true);

    http.onreadystatechange = function(){
        if(http.readyState == 4 && http.status == 200){
            var response = JSON.parse(http.responseText);
            if (Array.isArray(response)) {
                var html = ''
                response.forEach( function(element, index) {
                    html += element
                });
                document.getElementById("response").innerHTML = response;
            } else {
                document.getElementById("response").innerHTML = response;
            }

            // Enable the submit button again only if there is an error message
            if (http.status !== 200 || response.includes("error")) {
                submitButton.disabled = false;
                submitButton.textContent = "Submit";
            }
        }
    }

    http.send(formData);
}
```

4. Create the PHP file to process the data `send.php`:

```php
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
```

## Donation

If you find **richardsonoge/ajaxFormImage** helpful and want to support its development, consider donating. Your contribution helps ensure the maintenance and improvement of this open-source project. Every donation, no matter the size, is greatly appreciated. :)

 - [PayPal](https://www.paypal.me/richardsonoge)