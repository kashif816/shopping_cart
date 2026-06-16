<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

include("config.php");

if(isset($_GET['id']))
{
    $id=$_GET['id'];

    if(isset($_SESSION['cart'][$id]))
    {
        $_SESSION['cart'][$id]++;
    }
    else
    {
        $_SESSION['cart'][$id]=1;
    }

    echo "<script>alert('Product Added Successfully');</script>";
}

$result=mysqli_query($conn,"SELECT * FROM products");

?>

<!DOCTYPE html>
<html>
<head>
<title>SmartCart Store</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:linear-gradient(135deg,#0f172a,#1e293b);
min-height:100vh;
}

.navbar{
background:#111827;
padding:20px 50px;
display:flex;
justify-content:space-between;
align-items:center;
}

.logo{
color:white;
font-size:30px;
font-weight:bold;
}

.nav-links a{
text-decoration:none;
color:white;
margin-left:15px;
padding:10px 20px;
border-radius:10px;
background:#3b82f6;
}

.nav-links a:hover{
background:#2563eb;
}

.heading{
text-align:center;
color:white;
margin:30px 0;
font-size:40px;
}

.container{
width:90%;
margin:auto;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:25px;
padding-bottom:50px;
}

.card{
background:white;
border-radius:20px;
overflow:hidden;
box-shadow:0 10px 25px rgba(0,0,0,.3);
transition:.4s;
}

.card:hover{
transform:translateY(-10px);
}

.image{
height:250px;
overflow:hidden;
background:white;
}

.image img{
width:100%;
height:100%;
object-fit:contain;
padding:15px;
transition:.4s;
}

.card:hover .image img{
transform:scale(1.08);
}

.content{
padding:20px;
}

.content h3{
margin-bottom:10px;
}

.rating{
color:orange;
margin-bottom:10px;
}

.price{
font-size:25px;
font-weight:bold;
color:green;
margin-bottom:15px;
}

.btn{
display:block;
text-align:center;
text-decoration:none;
background:linear-gradient(135deg,#3b82f6,#8b5cf6);
color:white;
padding:12px;
border-radius:10px;
}

.btn:hover{
opacity:.9;
}

.footer{
text-align:center;
padding:20px;
color:white;
}

</style>
</head>

<body>

<div class="navbar">

<div class="logo">
🛒 SmartCart
</div>

<div class="nav-links">
<a href="cart.php">Cart</a>
<a href="logout.php">Logout</a>
</div>

</div>

<h1 class="heading">
Welcome To SmartCart Store
</h1>

<div class="container">

<?php

while($row=mysqli_fetch_assoc($result))
{

$image="";

if($row['product_name']=="Laptop")
{
$image="images/laptop.jpg";
}
elseif($row['product_name']=="Mouse")
{
$image="images/mouse.webp";
}
elseif($row['product_name']=="Keyboard")
{
$image="images/keyboard.webp";
}
elseif($row['product_name']=="Headphones")
{
$image="images/headphones.webp";
}

?>

<div class="card">

<div class="image">
<img src="<?php echo $image; ?>">
</div>

<div class="content">

<h3>
<?php echo $row['product_name']; ?>
</h3>

<div class="rating">
⭐⭐⭐⭐⭐
</div>

<div class="price">
₹<?php echo $row['price']; ?>
</div>

<a class="btn"
href="products.php?id=<?php echo $row['id']; ?>">
Add To Cart
</a>

</div>

</div>

<?php
}
?>

</div>

<div class="footer">
© 2026 SmartCart Shopping System
</div>

</body>
</html>