<?php
session_start();
include("config.php");

$message = "";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password,$row['password'])){
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['role'];
            header("Location: dashboard.php"); 
            exit();
        } else {
            $message = "Wrong Password!";
        }
    } else {
        $message = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Polling - Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
<style>
    .login-container {
    width: 400px;
    margin:60px auto;
    padding: 30px;
    background: rgba(255, 255, 255, 0.2); 
    backdrop-filter: blur(10px); 
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
    text-align: center;
}

.login-header{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    margin-bottom:15px;
}

.login-logo{
    width:65px;
    height:65px;
    object-fit:contain;
}
.login-container input,
.login-container button {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box; 
}

.login-container input {
    border: 1px solid #ccc;
}

.login-container button {
    background: #47494c;
    color: white;
    border: none;
    cursor: pointer;
}

.login-container button:hover {
    background: #1e1f1e;
}

.links {
    margin-top: 15px;
    display: flex;
    justify-content: center;
    font-size: 14px;
}

.links a {
    text-decoration: none;
    color: #111212;
}

.error-msg {
    color: red;
    margin-bottom: 10px;
}


body {
    margin: 0;
    padding: 0;
    padding-bottom:60px;
    background: url('dur2.webp') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
}
body.dark {
    background: url('dur2.webp') no-repeat center center fixed;
    background-size: cover;
    color: white;
}

body.dark .login-container {
    background-color: #1e1e1e;
}

body.dark input {
    background: #333;
    color: white;
    border: 1px solid #555;
}

body.dark .links a {
    color: #4da3ff;
}


@media(max-width:768px){
    .login-container {
        width: 90%;
    }
}


.site-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 0;
    width: 100vw;
    background: rgba(15, 14, 14, 0.25);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-top: 1px solid rgba(255,255,255,0.4);
    padding: 12px 20px;
    text-align: center;
    font-size: 13px;
    color: #f4f0f0;
    box-sizing: border-box;
    z-index: 100;
}

.site-footer a {
    color: #fdf7f7;
    text-decoration: none;
    margin: 0 8px;
}

.site-footer a:hover {
    text-decoration: underline;
}

body.dark .site-footer {
    background: rgba(10, 10, 10, 0.75);
    color: #aaa;
}

body.dark .site-footer a {
    color: #4da3ff;
}

</style>
</head>
<body>

<div class="login-container">

    <div class="login-header">
    <img src="adbu_app_logo_512x512.png" class="login-logo">
    <h2>Welcome Back 👋</h2>
</div>

    <?php if($message != "") echo "<p class='error-msg'>$message</p>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email Address" required>
        
        <div style="position:relative;">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span onclick="togglePassword()" 
                  style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer;">
                👁
            </span>
        </div>

        <button type="submit" name="login">Login</button>
    </form>

    <div class="links">
        <a href="forgot_password.php">Forgot Password?</a>
       
    </div>

    <button class="theme-btn" onclick="toggleTheme()">🌙 Toggle Theme</button>

</div>
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


<footer class="site-footer">
    &copy; <?php echo date('Y'); ?> Student Polling System &nbsp;| MCA Project&nbsp;
    
</footer>

</body>
</html>
