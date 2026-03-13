<?php
$host = "localhost";
$uname = "root";
$pwd   = "";
$dbname = "medical_inventory";

$conn = mysqli_connect($host, $uname, $pwd, $dbname);
if (!$conn) {
    die("Database connection failed");
}

if (isset($_POST['signup'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Encrypt password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO signup (fullname, username, email, password)
            VALUES ('$fullname', '$username', '$email', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: loginpg.php");
        exit();
    } else {
        echo "<script>alert('Signup failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up - Medical Inventory</title>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:'Roboto',sans-serif;
    min-height:100vh;
    padding:20px 0;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    background:url('loginbg.jpg') no-repeat center/cover;
    position:relative;
}
body::before{
    content:'';
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.4);
}
.header{
    position:relative;
    z-index:2;
    text-align:center;
    margin-bottom:18px;
}
.header img{width:180px;}
.header h1{
    font-family:'Montserrat',sans-serif;
    font-size:30px;
    color:#bcd3d2;
    margin-top:-26px;
}
.container{
    position:relative;
    z-index:2;
    width:511px;
    padding:42px 45px;
    border-radius:14px;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(12px);
    box-shadow:0 22px 45px rgba(0,0,0,0.35);
}
.container h2{
    font-family:'Montserrat',sans-serif;
    color:#fff;
    font-size:26px;
    margin-bottom:22px;
    text-align:center;
}
.input-group{margin-bottom:16px;}
.input-group label{color:#fff;font-size:14px;}
.input-group input{
    width:100%;
    padding:12px;
    margin-top:5px;
    border-radius:6px;
    border:none;
    outline:none;
}
button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:6px;
    background:#234241;
    color:#fff;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
}
button:hover{background:#0f2d2c;}
.switch{
    margin-top:14px;
    color:#fff;
    font-size:14px;
    text-align:center;
}
.switch a{color:#144d58;text-decoration:none;}
@media(max-width:650px){
    .container{width:92%;padding:35px 28px;}
}
</style>
</head>

<body>

<div class="header">
    <img src="logo.png">
    <h1>Medical Inventory Management System</h1>
</div>

<div class="container">
<h2>Create Account</h2>

<form method="POST">

    <div class="input-group">
        <label>Full Name</label>
        <input type="text" name="fullname" required>
    </div>

    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" required>
    </div>

    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" required>
    </div>

    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit" name="signup">Sign Up</button>

</form>

<div class="switch">
    Already have an account? <a href="loginpg.php">Login</a>
</div>

</div>
</body>
</html>