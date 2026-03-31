<?php
session_start();
include("config.php");


if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    die("Access Denied! Admin Only.");
}

if(isset($_POST['change_role'])){
    $user_id = intval($_POST['user_id']);
    $new_role = $_POST['role'];

    
    if($user_id == $_SESSION['user_id']){
        $message = "<p style='color:red;'>You cannot change your own role!</p>";
    } else {
        mysqli_query($conn, "UPDATE users SET role='$new_role' WHERE user_id='$user_id'");
        $message = "<p style='color:green;'>Role updated successfully!</p>";
    }
}


$users = mysqli_query($conn, "SELECT user_id, name, email, role FROM users ORDER BY name ASC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

body{
    font-family:'Poppins', sans-serif;
    background:#97b0bc;
    margin:0;
    padding:0;

    display:flex;
    flex-direction:column;
    min-height:100vh;
}

.page-content{
    flex:1;
}

.container{
    width:90%;
    max-width:900px;
    margin:40px auto;
    background:#94c8e1;
    padding:20px;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.title-box{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    margin-bottom:20px;
}

.logo{
    width:45px;
    height:45px;
    object-fit:contain;
}

h2{
    margin:0;
}


table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th, td{
    padding:12px;
    border-bottom:1px solid #ccc;
    text-align:center;
}

th{
    background:#416f9f;
    color:#fff;
}

select{
    padding:5px;
    border-radius:5px;
    border:1px solid #ccc;
}

button{
    padding:5px 10px;
    border:none;
    border-radius:5px;
    background:#28a745;
    color:#fff;
    cursor:pointer;
}

button:hover{
    background:#218838;
}

.message{
    text-align:center;
    margin-top:10px;
}


.back-btn{
    display:inline-block;
    margin-top:15px;
    text-decoration:none;
    font-weight:bold;
    color:#000;
}

footer{
    text-align:center;
    padding:15px;
    background:#2f4f6f;
    color:#fff;
    font-size:14px;
}

@media(max-width:600px){
table, th, td{
    font-size:12px;
}
button{
    padding:4px 8px;
}
}

</style>
</head>

<body>

<div class="page-content">

<div class="container">

<div class="title-box">
<img src="adbu_app_logo_512x512.png" class="logo">
<h2>Manage Users</h2>
</div>

<?php if(isset($message)) echo "<div class='message'>$message</div>"; ?>

<table>
<tr>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>

<?php while($user = mysqli_fetch_assoc($users)){ ?>
<tr>
<td><?php echo htmlspecialchars($user['name']); ?></td>
<td><?php echo htmlspecialchars($user['email']); ?></td>
<td>
<form method="POST" style="margin:0;">
<input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

<select name="role">
<option value="user" <?php if($user['role']=='user') echo 'selected'; ?>>User</option>
<option value="admin" <?php if($user['role']=='admin') echo 'selected'; ?>>Admin</option>
</select>

</td>
<td>
<button type="submit" name="change_role">Update</button>
</td>
</form>
</tr>
<?php } ?>

</table>

<a href="Dashboard.php" class="back-btn">⬅ Back to Dashboard</a>

</div>
</div>

<footer>
<p>© 2026 Student Polling System | MCA Project</p>
</footer>

</body>
</html>