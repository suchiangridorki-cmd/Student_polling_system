<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logged Out</title>
    <meta http-equiv="refresh" content="5;url=homepage.php">
    <style>
        body{
            margin:0;
            padding:0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            color:white;
            text-align:center;
        }

        .box{
            background: rgba(255,255,255,0.1);
            padding:40px;
            border-radius:15px;
            backdrop-filter: blur(10px);
            box-shadow:0 10px 25px rgba(0,0,0,0.3);
        }

        h2{
            margin-bottom:15px;
        }

        p{
            margin-bottom:20px;
        }

        .btn{
            padding:10px 20px;
            background:white;
            color:#764ba2;
            text-decoration:none;
            border-radius:25px;
            font-weight:bold;
        }

        .btn:hover{
            background:#f1f1f1;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>👋 You Have Successfully Logged Out</h2>
    <p>Thank you for using our Online Voting System.</p>
    <p>You will be redirected to Homepage in 5 seconds...</p>

    <a href="Login.php" class="btn">Login</a>
</div>

</body>
</html>