<?php
include("config.php");

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if(!preg_match("/^[0-9]{10}$/", $phone)){
        $message = "Phone number must be exactly 10 digits!";
    }

    
    elseif(strlen($password) < 6){
        $message = "Password must be at least 6 characters long!";
    }
    elseif(!preg_match("/[A-Z]/", $password)){
        $message = "Password must contain at least one uppercase letter!";
    }
    elseif(!preg_match("/[0-9]/", $password)){
        $message = "Password must contain at least one number!";
    }
    else{

        $password = password_hash($password, PASSWORD_DEFAULT);

        $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

        if(mysqli_num_rows($check) > 0){
            $message = "Email already registered!";
        } else {
            mysqli_query($conn,"INSERT INTO users(name,email,phone,password) 
                                VALUES('$name','$email','$phone','$password')");
            $message = "Registered Successfully!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Polling - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="register-container">
    <div class="title-logo">
    <img src="adbu_app_logo_512x512.png" alt="Logo">
    <h2>Create Account</h2>
</div>

    <?php if(isset($message)) echo "<p class='message'>$message</p>"; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>

    
        <input type="tel" name="phone" placeholder="Phone Number"
               pattern="[0-9]{10}" title="Enter 10 digit phone number" required>

       
        <div style="position:relative;">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span onclick="togglePassword()" 
                  style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer;">
                👁
            </span>
        </div>

        <button type="submit" name="register">Register</button>
    </form>

    <p>Already have an account? <a href="Login.php">Login</a></p>

    <button class="theme-btn" onclick="toggleTheme()">🌙 Toggle Theme</button>

</div>

<script>
function togglePassword() {
    var pass = document.getElementById("password");
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
</script>

<footer>
    © 2026 Student Polling System | MCA Project
</footer>

</body>
</html>