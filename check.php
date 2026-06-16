<?php
session_start();

if(empty($_SESSION['cart']))
{
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#667eea,#764ba2);
}

.container{
    width:450px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.3);
}

h1{
    text-align:center;
    color:white;
    margin-bottom:25px;
}

label{
    color:white;
    display:block;
    margin-top:10px;
    margin-bottom:5px;
}

input,
textarea{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    margin-bottom:10px;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#22c55e;
    color:white;
    font-size:18px;
    cursor:pointer;
}

button:hover{
    background:#16a34a;
}

</style>
</head>
<body>

<div class="container">

<h1>🛍 Checkout</h1>

<form action="place_order.php" method="post">

<label>Customer Name</label>
<input type="text"
name="customer_name"
required>

<label>Phone Number</label>
<input type="text"
name="phone"
required>

<label>Address</label>
<textarea
name="address"
rows="4"
required></textarea>

<button type="submit">
Place Order
</button>

</form>

</div>

</body>
</html>