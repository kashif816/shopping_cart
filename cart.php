<?php
session_start();
include("config.php");

if(isset($_POST['update']))
{
    foreach($_POST['qty'] as $id=>$qty)
    {
        $_SESSION['cart'][$id]=$qty;
    }
}

if(isset($_GET['remove']))
{
    $id=$_GET['remove'];
    unset($_SESSION['cart'][$id]);
}

$subtotal=0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Shopping Cart</title>

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
    padding:30px;
}

.title{
    text-align:center;
    color:white;
    margin-bottom:30px;
    font-size:40px;
}

.container{
    width:95%;
    margin:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}

th{
    background:linear-gradient(135deg,#3b82f6,#8b5cf6);
    color:white;
    padding:15px;
}

td{
    padding:15px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

input[type=number]{
    width:70px;
    padding:8px;
    text-align:center;
    border-radius:8px;
    border:1px solid #ccc;
}

.remove{
    background:#ef4444;
    color:white;
    text-decoration:none;
    padding:8px 15px;
    border-radius:8px;
}

.remove:hover{
    background:#dc2626;
}

.update-btn{
    margin-top:20px;
    padding:12px 25px;
    border:none;
    border-radius:10px;
    background:#22c55e;
    color:white;
    cursor:pointer;
    font-size:16px;
}

.summary{
    width:350px;
    margin-top:30px;
    margin-left:auto;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}

.summary h2{
    margin-bottom:20px;
}

.summary p{
    margin:10px 0;
    font-size:18px;
}

.total{
    font-size:24px;
    color:#16a34a;
    font-weight:bold;
}

.checkout{
    display:block;
    text-align:center;
    margin-top:20px;
    background:linear-gradient(135deg,#3b82f6,#8b5cf6);
    color:white;
    text-decoration:none;
    padding:12px;
    border-radius:10px;
}

.checkout:hover{
    opacity:.9;
}

.back{
    display:inline-block;
    margin-bottom:20px;
    color:white;
    text-decoration:none;
}

.empty{
    text-align:center;
    color:white;
    font-size:24px;
}

</style>

</head>
<body>

<a href="products.php" class="back">
← Continue Shopping
</a>

<h1 class="title">🛒 Your Shopping Cart</h1>

<div class="container">

<?php
if(!empty($_SESSION['cart']))
{
?>

<form method="post">

<table>

<tr>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
<th>Action</th>
</tr>

<?php

foreach($_SESSION['cart'] as $id=>$qty)
{
    $result=mysqli_query($conn,
    "SELECT * FROM products WHERE id=$id");

    $row=mysqli_fetch_assoc($result);

    $total=$row['price']*$qty;

    $subtotal+=$total;
?>

<tr>

<td><?php echo $row['product_name']; ?></td>

<td>₹<?php echo $row['price']; ?></td>

<td>
<input type="number"
name="qty[<?php echo $id; ?>]"
value="<?php echo $qty; ?>"
min="1">
</td>

<td>₹<?php echo $total; ?></td>

<td>
<a class="remove"
href="cart.php?remove=<?php echo $id; ?>">
Remove
</a>
</td>

</tr>

<?php
}
?>

</table>

<button class="update-btn"
type="submit"
name="update">
Update Cart
</button>

</form>

<?php

$gst=$subtotal*0.18;
$grandtotal=$subtotal+$gst;

?>

<div class="summary">

<h2>💳 Bill Summary</h2>

<p>Subtotal: ₹<?php echo $subtotal; ?></p>

<p>GST (18%): ₹<?php echo round($gst,2); ?></p>

<hr><br>

<p class="total">
Total: ₹<?php echo round($grandtotal,2); ?>
</p>

<a class="checkout"
href="checkout.php">
Proceed To Checkout
</a>

</div>

<?php
}
else
{
    echo "<p class='empty'>🛒 Your Cart is Empty</p>";
}
?>

</div>

</body>
</html>