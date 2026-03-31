<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("config.php");


if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: Dashboard.php");
    exit();
}

$feedbacks = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin - Contact Feedback</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

body{
    font-family: Arial, sans-serif;
    background:#9fcfe9;
    color:black;
    margin:0;
    padding:0;

    display:flex;
    flex-direction:column;
    min-height:100vh;
}

.page-content{
    flex:1;
    padding:30px;
}


.header{
    text-align:center;
    margin-bottom:25px;
}

.logo{
    width:70px;
    height:70px;
    object-fit:contain;
    margin-bottom:10px;
}

.header h2{
    margin:0;
}


.back-link{
    color:black;
    text-decoration:none;
    display:inline-block;
    margin-bottom:20px;
}


.feedback-box{
    background:#ddd;
    padding:20px;
    border-radius:10px;
    margin-bottom:15px;
    color: black;
}

.feedback-box p{
    margin:5px 0;
}

.date{
    font-size:12px;
    opacity:0.7;
}


footer{
    text-align:center;
    padding:15px;
    background:#265165;
    color:white;
    font-size:14px;
}

</style>
</head>

<body>

<div class="page-content">

<div class="header">
<img src="adbu_app_logo_512x512.png" class="logo">
<h2>Contact Feedback Messages</h2>
</div>

<?php
if(mysqli_num_rows($feedbacks) > 0){
    while($row = mysqli_fetch_assoc($feedbacks)){
        echo "<div class='feedback-box'>";
        echo "<p><strong>Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
        echo "<p><strong>Message:</strong> " . htmlspecialchars($row['message']) . "</p>";
        echo "<p class='date'>" . $row['created_at'] . "</p>";
        echo "</div>";
    }
}else{
    echo "<p>No feedback messages found.</p>";
}
?>
<a href="Dashboard.php" class="back-link">⬅ Back to Dashboard</a>

</div>

<footer>
<p>© 2026 Student Polling System | MCA Project</p>
</footer>

</body>
</html>