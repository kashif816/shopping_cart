<?php

session_start();

if(!isset($_SESSION['admin']))
{
header("Location: admin_login.php");
exit();
}

include("config.php");

$total=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) as total FROM contacts")
);

$pending=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) as total FROM contacts WHERE status='Pending'")
);

$resolved=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT COUNT(*) as total FROM contacts WHERE status='Resolved'")
);

$result=mysqli_query($conn,
"SELECT * FROM contacts ORDER BY id DESC");

?>

<!DOCTYPE html>

<html>
<head>

<title>Admin Dashboard</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins,sans-serif;
}

body{
background:linear-gradient(
135deg,
#0f172a,
#1e293b,
#312e81
);
min-height:100vh;
padding:30px;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.header h1{
color:white;
}

.logout{
background:#ef4444;
color:white;
padding:12px 20px;
text-decoration:none;
border-radius:10px;
}

.cards{
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(250px,1fr));
gap:20px;
margin-bottom:30px;
}

.card{
padding:25px;
border-radius:20px;
color:white;
}

.total{
background:linear-gradient(135deg,#3b82f6,#2563eb);
}

.pending{
background:linear-gradient(135deg,#f59e0b,#d97706);
}

.resolved{
background:linear-gradient(135deg,#22c55e,#16a34a);
}

.card h1{
font-size:45px;
}

.table-box{
background:white;
padding:20px;
border-radius:20px;
overflow:auto;
}

table{
width:100%;
border-collapse:collapse;
}

th{
background:#8b5cf6;
color:white;
padding:15px;
}

td{
padding:12px;
border-bottom:1px solid #ddd;
text-align:center;
}

.view-btn{
background:#3b82f6;
color:white;
padding:8px 12px;
text-decoration:none;
border-radius:8px;
}

.delete-btn{
background:#ef4444;
color:white;
padding:8px 12px;
text-decoration:none;
border-radius:8px;
margin-left:5px;
}

</style>

</head>

<body>

<div class="header">

<h1>
📩 Contact Dashboard
</h1>

<a href="logout.php" class="logout">
Logout
</a>

</div>

<div class="cards">

<div class="card total">
<h3>Total Messages</h3>
<h1><?php echo $total['total']; ?></h1>
</div>

<div class="card pending">
<h3>Pending</h3>
<h1><?php echo $pending['total']; ?></h1>
</div>

<div class="card resolved">
<h3>Resolved</h3>
<h1><?php echo $resolved['total']; ?></h1>
</div>

</div>

<div class="table-box">

<table>

<tr>
<th>ID</th>
<th>Contact ID</th>
<th>Name</th>
<th>Email</th>
<th>Subject</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['contact_id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['subject']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a
href="view_message.php?id=<?php echo $row['id']; ?>"
class="view-btn">

View

</a>

<a
href="delete_message.php?id=<?php echo $row['id']; ?>"
class="delete-btn"
onclick="return confirm('Delete this message?')">

Delete

</a>

</td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>