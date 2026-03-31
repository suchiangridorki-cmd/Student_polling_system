<?php
session_start();
include("config.php");

if(!isset($_SESSION['user_id'])){
    header("Location: Login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";


if(isset($_POST['vote_submit'])){

    $poll_id   = $_POST['poll_id'];
    $option_id = $_POST['option_id'];

    
    $check = mysqli_query($conn,
        "SELECT * FROM votes 
         WHERE user_id='$user_id' AND poll_id='$poll_id'"
    );

    if(mysqli_num_rows($check) == 0){

        mysqli_query($conn,
            "INSERT INTO votes(poll_id,user_id,option_id)
             VALUES('$poll_id','$user_id','$option_id')"
        );

        $message = "<p class='success'>✅ Vote Submitted Successfully!</p>";

    } else {
        $message = "<p class='error'>⚠️ You already voted on this poll!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Vote</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

body{
    min-height:100vh;
    display:flex;
    flex-direction:column;
    background: #9fcfe9;
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

.vote-container {
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    font-family: Arial, sans-serif;
    background: #ffffffcc;
}

.vote-container h2 {
    text-align: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #ddd;
}

.poll-card {
    background: #faf3ea;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.poll-card h3 {
    margin-bottom: 15px;
}

.option {
    display: block;
    margin-bottom: 10px;
    font-size: 16px;
}

.vote-btn {
    margin-top: 15px;
    padding: 10px 15px;
    background: #47494c;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

.vote-btn:hover {
    background: #1e1f1e;
}

.success {
    color: green;
    text-align: center;
}

.error {
    color: red;
    text-align: center;
}

.back-btn {
    display: block;
    text-align: center;
    margin-top: 20px;
    text-decoration: none;
    color: #202224;
}

.back-link {
    color: black;
    text-decoration: none;
}

.back-link:hover {
    color: #333;
}

footer{
    text-align:center;
    padding:15px;
    background:#222;
    color:white;
}


@media(max-width:600px){
    .vote-container {
        padding: 15px;
    }

    .poll-card {
        padding: 15px;
    }
}

</style>
</head>

<body>

<div class="page-content">

<div class="vote-container">
    <div class="logo-box">
    <img src="adbu_app_logo_512x512.png" class="logo">
    <h2>Active Polls</h2>
</div>

<?php echo $message; ?>

<?php
$polls = mysqli_query($conn,"SELECT * FROM polls WHERE status='active'");

while($p = mysqli_fetch_assoc($polls)){
$poll_id = $p['poll_id'];
?>

<div class="poll-card">
<h3><?php echo $p['title']; ?></h3>

<form method="POST">

<input type="hidden" name="poll_id" value="<?php echo $poll_id; ?>">

<?php
$options = mysqli_query($conn,
"SELECT * FROM options WHERE poll_id='$poll_id'"
);

while($opt = mysqli_fetch_assoc($options)){
?>

<label class="option">
<input type="radio" 
name="option_id" 
value="<?php echo $opt['option_id']; ?>" 
required>
<?php echo $opt['option_text']; ?>
</label>

<?php } ?>

<button type="submit" name="vote_submit" class="vote-btn">
Submit Vote
</button>

<a href="Dashboard.php" class="back-btn">⬅ Back to Dashboard</a>

</form>
</div>

<?php } ?>

<br>

</div>

</div>

<footer>
<p>© 2026 Student Polling System | MCA Project</p>
</footer>

</body>
</html>