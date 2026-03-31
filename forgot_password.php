<?php
include("config.php");

$message = "";
$msg_type = "";

if(isset($_POST['reset'])){
    $email = $_POST['email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){
        mysqli_query($conn,"UPDATE users SET password='$new_password' WHERE email='$email'");
        $message = "Password Updated Successfully!";
        $msg_type = "success";
    } else {
        $message = "Email not found!";
        $msg_type = "error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
</head>
<body>

<div class="forgot-container">

    <h2> Reset Your Password</h2>

    <?php if($message != ""): ?>
        <p class="<?php echo $msg_type; ?>"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter Registered Email" required>
        <input type="password" name="new_password" placeholder="Enter New Password" required>
        <button type="submit" name="reset">Reset Password</button>
    </form>

    <div class="links">
        <a href="login.php">Back to Login</a>
    </div>

    <button class="theme-btn" onclick="toggleTheme()">🌙 Toggle Theme</button>

</div>

</body>
</html>