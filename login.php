<?php

session_start();
include("config.php");

if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    $sql="SELECT * FROM users
          WHERE email='$email'
          AND password='$password'";

    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
        $_SESSION['user']=$email;

        header("Location: products.php");
    }
    else
    {
        echo "<script>alert('Invalid Login');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#0f172a,#1e293b);
}

.container{
width:400px;
padding:30px;
background:white;
border-radius:20px;
box-shadow:0 10px 30px rgba(0,0,0,.3);
}

h1{
text-align:center;
margin-bottom:20px;
}

input{
width:100%;
padding:12px;
margin:10px 0;
border:1px solid #ddd;
border-radius:10px;
}

button{
width:100%;
padding:12px;
background:#3b82f6;
border:none;
border-radius:10px;
color:white;
font-size:16px;
cursor:pointer;
}

p{
text-align:center;
margin-top:15px;
}

a{
text-decoration:none;
color:#3b82f6;
}

</style>
</head>

<body>

<div class="container">

<h1>Welcome Back 👋</h1>

<form method="post">

<input type="email"
name="email"
placeholder="Email"
required>

<input type="password"
name="password"
placeholder="Password"
required>

<button name="login">
Login
</button>

</form>

<p>
New User?
<a href="signup.php">Create Account</a>
</p>

</div>

</body>
</html>