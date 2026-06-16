<?php

session_start();
include("config.php");

$name=$_POST['customer_name'];

$subtotal=0;

foreach($_SESSION['cart'] as $id=>$qty)
{
    $result=mysqli_query($conn,
    "SELECT * FROM products WHERE id=$id");

    $row=mysqli_fetch_assoc($result);

    $subtotal += $row['price'] * $qty;
}

$gst = $subtotal * 0.18;
$total = $subtotal + $gst;

mysqli_query($conn,

"INSERT INTO orders
(customer_name,subtotal,gst,total)

VALUES
('$name','$subtotal','$gst','$total')"

);

$order_id = mysqli_insert_id($conn);

foreach($_SESSION['cart'] as $id=>$qty)
{
    $result=mysqli_query($conn,
    "SELECT * FROM products WHERE id=$id");

    $row=mysqli_fetch_assoc($result);

    mysqli_query($conn,

    "INSERT INTO order_items
    (order_id,product_id,quantity,price)

    VALUES
    ('$order_id',
    '$id',
    '$qty',
    '".$row['price']."')"

    );
}

unset($_SESSION['cart']);

?>

<!DOCTYPE html>
<html>
<head>
<title>Order Success</title>

<style>

body{
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(135deg,#11998e,#38ef7d);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.card{
    background:white;
    width:500px;
    padding:30px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}

.success{
    font-size:70px;
}

h1{
    color:#16a34a;
}

.details{
    margin-top:20px;
    text-align:left;
}

.details p{
    margin:10px 0;
    font-size:18px;
}

.btn{
    display:inline-block;
    margin-top:20px;
    background:#2563eb;
    color:white;
    padding:12px 25px;
    text-decoration:none;
    border-radius:10px;
}

</style>

</head>
<body>

<div class="card">

<div class="success">
✅
</div>

<h1>Order Placed Successfully!</h1>

<div class="details">

<p><b>Order ID:</b> <?php echo $order_id; ?></p>

<p><b>Customer:</b> <?php echo $name; ?></p>

<p><b>Subtotal:</b> ₹<?php echo $subtotal; ?></p>

<p><b>GST:</b> ₹<?php echo round($gst,2); ?></p>

<p><b>Total:</b> ₹<?php echo round($total,2); ?></p>

</div>

<a class="btn"
href="products.php">
Continue Shopping
</a>

</div>

</body>
</html>