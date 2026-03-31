<?php
$conn = mysqli_connect("localhost", "your_db_user", "your_db_password", "student_polling_system");
if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}
?>