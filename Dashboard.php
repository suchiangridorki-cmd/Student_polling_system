<?php
session_start();
include("config.php");


if(!isset($_SESSION['user_id'])){
    header("Location: Login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_query = mysqli_query($conn, "SELECT name, email, role FROM users WHERE user_id='$user_id'");
$user = mysqli_fetch_assoc($user_query);


$total_polls = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM polls"))['total'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$total_votes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM votes"))['total'];


$active_polls = mysqli_query($conn, "SELECT * FROM polls ORDER BY poll_id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>


*{box-sizing:border-box;margin:0;padding:0;}

body{
    font-family:'Poppins',sans-serif;
    background:#b9cbd3;
    color:#21465c;
    display:flex;
    flex-direction:column;
    min-height:100vh;
}

.layout{
    display:flex;
    flex:1;
}

.section{
display:none;
}


.sidebar{
    width:250px;
    background:#9fcfe9;
    height:100vh;
    padding:20px;
    position:fixed;
    transition:0.3s;
}

.sidebar h2{
    color:#21465c;
    margin-bottom:10px;
}

.sidebar a{
    display:block;
    padding:12px;
    margin:8px 0;
    text-decoration:none;
    color:#21465c;
    border-radius:6px;
    transition:0.3s;
}

.sidebar a:hover{
    background:#d1e4f3;
}

.profile-box{
    background:#265165;
    padding:20px;
    border-radius:10px;
    color:white;
    max-width:400px;
}

.logout{
    background:#efbdc2;
}

.role{
    font-size:12px;
    opacity:0.7;
}


.logo-box{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:15px;
}

.logo{
    width:65px;
    height:65px;
    object-fit:contain;
}


.main{
    margin-left:270px;
    padding:40px;
    width:100%;
}

h1{
    margin-bottom:30px;
}


.stats{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom:40px;
}

.card{
    background:#4f8bbd;
    padding:25px;
    border-radius:12px;
    flex:1;
    min-width:180px;
    text-align:center;
}
.card h3{
    font-size:28px;
    margin-bottom:5px;
}


.recent-polls{
    background:linear-gradient(135deg,#4f8bbd,#77acdb);
    padding:20px;
    border-radius:12px;
    color:#fff;
}

.recent-polls h2{
    margin-bottom:15px;
}

.poll-card{
    background:rgba(255,255,255,0.1);
    color:#fff;
    padding:15px;
    border-radius:8px;
    margin-top:10px;
    box-shadow:0 3px 8px rgba(0,0,0,0.2);
    display:flex;
    justify-content:space-between;
    align-items:center;
    transition:0.3s;
}

.poll-card:hover{
    background:rgba(255,255,255,0.2);
    transform:translateY(-2px);
}

.vote-btn{
    background:#28a745;
    border:none;
    color:#fff;
    padding:8px 12px;
    border-radius:5px;
    cursor:pointer;
    font-weight:500;
    transition:0.3s;
}

.vote-btn:hover{
    background:#218838;
}

.welcome-text{
    text-align: center;
    font-size: 26px;   
    margin-top: 10px;  
    margin-bottom: 25px; 
    font-weight: 500;
}

.mobile-menu{
    display:none;
    font-size:24px;
    padding:15px;
    background:#1c1c1c;
    cursor:pointer;
}


footer{
    position:fixed;
    bottom:0;
    left:250px;
    width:calc(100% - 250px);
    text-align:center;
    padding:15px;
    background:#222;
    color:white;
}


@media(max-width:768px){

.sidebar{
    left:-260px;
    position:fixed;
}

.sidebar.active{
    left:0;
}

.main{
    margin-left:0;
    padding:20px;
}

footer{
    left:0;
    widtht:100%;
}

.mobile-menu{
    display:block;
}

.stats{
    flex-direction:column;
}

.poll-card{
    flex-direction:column;
    align-items:flex-start;
}

}

</style>
</head>

<body>

<div class="mobile-menu" onclick="toggleSidebar()">☰</div>

<div class="layout">

<div class="sidebar" id="sidebar">

<div class="logo-box">
<img src="adbu_app_logo_512x512.png" class="logo">
<h2>Campus Poll Portal</h2>
</div>

<p><?php echo $user['name']; ?></p>
<span class="role"><?php echo ucfirst($user['role']); ?></span>

<a href="#" onclick="showSection('profile')">👤 Profile</a>
<a href="Dashboard.php">🏠 Dashboard</a>
<a href="Voting_page.php">🗳️ Vote</a>
<a href="results.php">📊 Results</a>

<?php if($user['role'] == 'admin'){ ?>
<a href="Create_poll.php">➕ Create Poll</a>
<a href="manageusers.php">👥 Manage Users</a>
<a href="admin_feedback.php">💬 View Feedback</a>
<?php } ?>

<a href="Logout.php" class="logout">🚪 Logout</a>

</div>


<div class="main">
    <div id="profile" class="section" style="display:none;">

<h2>My Profile</h2>

<div class="profile-box">

<p><b>Name:</b> <?php echo $user['name']; ?></p>

<p><b>Email:</b> <?php echo $user['email']; ?></p>

<p><b>Role:</b> <?php echo $user['role']; ?></p>
</div>

</div>

<div id="dashboard" class="section" style="display:block;">
<h1>Dashboard</h1>
<p class="welcome-text">Welcome to the Student Polling and Survey System.</p>


<div class="stats">

<div class="card">
<h3><?php echo $total_polls; ?></h3>
<p>Total Polls</p>
</div>

<div class="card">
<h3><?php echo $total_users; ?></h3>
<p>Total Users</p>
</div>

<div class="card">
<h3><?php echo $total_votes; ?></h3>
<p>Total Votes</p>
</div>
</div>


<div class="recent-polls">

<h2>Recent Polls</h2>

<?php while($poll = mysqli_fetch_assoc($active_polls)){ ?>

<div class="poll-card">

<span><?php echo $poll['title']; ?></span>

<form method="POST" action="Voting_page.php" style="margin:0;">
<input type="hidden" name="poll_id" value="<?php echo $poll['poll_id']; ?>">
<button type="submit" class="vote-btn">Vote</button>
</form>

</div>

<?php } ?>

</div>

</div>

</div> 

</div>
</div>
<footer>
<p>© 2026 Student Polling System | MCA Project</p>
</footer>

<script>

function toggleSidebar(){
document.getElementById("sidebar").classList.toggle("active");
}

function showSection(section){

if(section === "profile"){
document.getElementById("profile").style.display = "block";
document.getElementById("dashboard").style.display = "none";
}else{
document.getElementById("profile").style.display = "none";
document.getElementById("dashboard").style.display = "block";
}

}
</script>

</body>
</html>
