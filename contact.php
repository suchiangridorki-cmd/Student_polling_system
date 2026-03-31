<?php
include("config.php");

$message = "";

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    if(!empty($name) && !empty($email) && !empty($msg)){

        $query = "INSERT INTO contact_messages (name, email, message) 
                  VALUES ('$name','$email','$msg')";

        if(mysqli_query($conn, $query)){
            $message = "Message Sent Successfully!";
        } else {
            $message = "Something went wrong!";
        }

    } else {
        $message = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url("dur2.webp") no-repeat center center fixed;
            background-size: cover;
        }

        .contact-container {
            width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            text-align: center;
            color: black;
        }

        .contact-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input, textarea {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            font-size: 16px;
        }

        button {
            width: 90%;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #218838;
        }

        .msg {
            margin-bottom: 10px;
            font-weight: bold;
        }

        a {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        
        @media(max-width:768px){
            .contact-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="contact-container">
    <h2>Contact Us</h2>

    <?php if($message != "") echo "<p class='msg'>$message</p>"; ?>

    <form method="POST" action="">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" rows="5" placeholder="Your Message" required></textarea>

        <button type="submit" name="send">Send Message</button>
    </form>

    <br>
    <a href="homepage.php">⬅ Back to Home</a>
</div>

</body>
</html>