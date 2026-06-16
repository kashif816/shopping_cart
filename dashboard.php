<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>SmartCart Admin Dashboard</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:#f4f6fb;
}

.navbar{
height:80px;
background:#17182e;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 40px;
color:white;
}

.logo{
font-size:30px;
font-weight:bold;
}

.admin{
font-size:18px;
}

.hero{
height:130px;
background:#17182e;
border-bottom-left-radius:50% 40px;
border-bottom-right-radius:50% 40px;
}

.content{
padding:30px;
margin-top:-60px;
}

.heading{
font-size:45px;
font-weight:bold;
margin-bottom:30px;
color:#222;
}

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
gap:30px;
}

.card{
background:white;
border-radius:25px;
padding:35px;
position:relative;
overflow:hidden;
box-shadow:0 8px 25px rgba(0,0,0,.08);
transition:.3s;
}

.card:hover{
transform:translateY(-10px);
}

.circle{
position:absolute;
width:120px;
height:120px;
background:#f0ecff;
border-radius:50%;
top:-30px;
right:-30px;
}

.icon{
font-size:50px;
text-align:center;
margin-bottom:20px;
}

.card h2{
text-align:center;
font-size:36px;
color:#222;
margin-bottom:15px;
}

.card p{
text-align:center;
color:#666;
margin-bottom:25px;
font-size:18px;
}

.btn{
display:block;
text-align:center;
text-decoration:none;
background:#171c28;
color:white;
padding:15px;
border-radius:10px;
font-size:18px;
transition:.3s;
}

.btn:hover{
background:#2b3247;
}

.footer{
text-align:center;
padding:30px;
color:#777;
}

</style>

</head>

<body>

<div class="navbar">

<div class="logo">
🛒 SmartCart Admin
</div>

<div class="admin">
👤 Admin
</div>

</div>

<div class="hero"></div>

<div class="content">

<div class="heading">
Welcome, Admin
</div>

<div class="cards">

<div class="card">

<div class="circle"></div>

<div class="icon">
📦
</div>

<h2>Products</h2>

<p>
Manage products and inventory.
</p>

<a href="../products.php" class="btn">
Open
</a>

</div>

<div class="card">

<div class="circle"></div>

<div class="icon">
🛒
</div>

<h2>Orders</h2>

<p>
View customer orders and status.
</p>

<a href="orders.php" class="btn">
Open
</a>

</div>

<div class="card">

<div class="circle"></div>

<div class="icon">
💰
</div>

<h2>Billing & Reports</h2>

<p>
Review sales and revenue reports.
</p>

<a href="reports.php" class="btn">
Open
</a>

</div>

<div class="card">

<div class="circle"></div>

<div class="icon">
🚪
</div>

<h2>Logout</h2>

<p>
Securely logout from dashboard.
</p>

<a href="logout.php" class="btn">
Open
</a>

</div>

</div>

</div>

<div class="footer">
© 2026 SmartCart Shopping Management System
</div>

</body>
</html>