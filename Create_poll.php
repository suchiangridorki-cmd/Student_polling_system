<?php
session_start();
include("config.php");

/* ======================
   ACCESS CONTROL
====================== */
if(!isset($_SESSION['user_id'])){
    header("Location: Login.php");
    exit();
}

if($_SESSION['role'] != 'admin'){
    die("Access Denied! Admin Only.");
}

$message = "";

/* ======================
   CREATE POLL
====================== */
if(isset($_POST['create'])){

    $title  = mysqli_real_escape_string($conn, $_POST['title']);
    $expiry = $_POST['expiry'];
    $options = $_POST['options'];

    if(!empty($title) && !empty($expiry) && count($options) >= 2){

        mysqli_query($conn,"INSERT INTO polls(title, created_by, expiry_date, status) 
                            VALUES('$title','".$_SESSION['user_id']."','$expiry','active')");

        $poll_id = mysqli_insert_id($conn);

        foreach($options as $opt){
            $opt = mysqli_real_escape_string($conn,$opt);
            if(!empty($opt)){
                mysqli_query($conn,"INSERT INTO options(poll_id,option_text) VALUES('$poll_id','$opt')");
            }
        }

        $message = "<p class='success-message'>✅ Poll Created Successfully!</p>";
    } else {
        $message = "<p class='error-message'>⚠ Please enter at least 2 options!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Poll</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

body{
    margin:0;
    padding:0;
    font-family:'Poppins', sans-serif;

    background-image:url('dur2.webp');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;

    display:flex;
    flex-direction:column;
    min-height:100vh;
}

.page-content{
    flex:1;
}

.logo-box{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    margin-bottom:20px;
}

.logo{
    width:60px;
    height:60px;
    object-fit:contain;
}

.container{
    width:100%;
    max-width:500px;
    margin:60px auto;
    padding:30px;
    background:rgba(255,255,255,0.2);
    backdrop-filter:blur(10px);
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.3);
    text-align:center;
    color:#1c1a1a;
}

.container h2{
    color:#141313;
    font-weight:600;
    margin-bottom:20px;
}

.container input,
.container button{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:5px;
    font-size:16px;
    box-sizing:border-box;
}

.container input{
    border:1px solid #b57caa;
    background:#fff;
    color:#000;
    font-size:14px;
}

.container button{
    background:#47494c;
    color:#fff;
    border:none;
    cursor:pointer;
    font-size:15px;
    font-weight:500;
    transition:0.3s ease;
}

.container button:hover{
    background:#121314;
}

.success-message{
    color:green;
    margin-bottom:15px;
}

.error-message{
    color:red;
    margin-bottom:15px;
}

a{
    color:#252729;
    text-decoration:none;
    font-weight:bold;
}

a:hover{
    text-decoration:underline;
}

.add-btn{
    background:#2b7a78;
}

.add-btn:hover{
    background:#205e5c;
}

footer{
    text-align:center;
    padding:15px;
    background:rgba(0,0,0,0.6);
    color:#fff;
    font-size:14px;
}

@media(max-width:500px){
.container{
    width:90%;
    padding:20px;
}
}

</style>

<script>

function addOption(){
    const container = document.getElementById("options-container");

    const input = document.createElement("input");
    input.type="text";
    input.name="options[]";
    input.placeholder="New Option";
    input.required=true;

    container.appendChild(input);
}

</script>

</head>

<body>

<div class="page-content">
<div class="container">

<div class="logo-box">
<img src="adbu_app_logo_512x512.png" class="logo">
<h2>Create New Poll</h2>
</div>

<?php echo $message; ?>

<form method="POST">

<input type="text" name="title" placeholder="Poll Title" required>

<div id="options-container">

<input type="text" name="options[]" placeholder="Option 1" required>

<input type="text" name="options[]" placeholder="Option 2" required>

</div>

<button type="button" onclick="addOption()" class="add-btn">➕ Add More Option</button>

<input type="date" name="expiry" required>

<button type="submit" name="create">Create Poll</button>

</form>

<br>
<a href="Dashboard.php">⬅ Back to Dashboard</a>

</div>
</div>

<footer>
<p>© 2026 Student Polling System | MCA Project</p>
</footer>

</body>
</html>