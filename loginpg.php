<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "medical_inventory");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM signup WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: medicine.php");
            exit();
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "User not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Medical Inventory Management System - Login</title>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">

<style>
/* (Your existing CSS – unchanged for design safety) */
*{box-sizing:border-box;margin:0;padding:0}
body{
    font-family:'Roboto',sans-serif;
    height:100vh;
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
    z-index:1;
}
.header{z-index:2;text-align:center;margin-bottom:30px}
.header img{width:200px}
.header h1{
    font-family:'Montserrat',sans-serif;
    font-size:35px;
    color:#bcd3d2;
    margin-top:-30px;
}
.login-container{
    z-index:2;
    width:500px;
    padding:50px 40px;
    border-radius:12px;
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(10px);
    box-shadow:0 20px 40px rgba(0,0,0,0.3);
}
.login-container h2{
    text-align:center;
    color:#fff;
    margin-bottom:30px;
}
.input-group{
    margin-bottom:20px;
}
.input-group label{
    color:#fff;
    font-size:18px;
}
.input-group input{
    width:100%;
    padding:14px;
    border-radius:6px;
    border:1px solid #ccc;
}
button{
    width:100%;
    padding:14px;
    background:#234241;
    color:#fff;
    border:none;
    border-radius:6px;
    font-weight:600;
}
.error{
    color:#ffb3b3;
    text-align:center;
    margin-bottom:10px;
}
.switch{
    margin-top:15px;
    color:#fff;
    text-align:center;
}
.switch a{
    color:#104e5a;
    text-decoration:none;
}
</style>
</head>

<body>

<div class="header">
    <img src="logo.png">
    <h1>Medical Inventory Management System</h1>
</div>

<div class="login-container">
    <h2>Login</h2>

    <?php if ($error != "") { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="login">LOGIN</button>

        <div class="switch">
            Don't have an account? <a href="signup.php">Sign up</a>
        </div>
    </form>
</div>

</body>
</html>