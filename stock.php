<?php
$conn = mysqli_connect("localhost","root","","medical_inventory");

if(!$conn){
die("Connection failed".mysqli_connect_error());
}

/* DELETE */

if(isset($_GET['delete'])){

$id=$_GET['delete'];

mysqli_query($conn,"DELETE FROM purchaseform WHERE id='$id'");

header("Location: stock.php");
exit();
}

/* FETCH DATA */

$data=mysqli_query($conn,"SELECT * FROM purchaseform ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>

<title>Stock In</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
font-family:'Segoe UI';
background:linear-gradient(to right,#e0f7f6,#f4f9f9);
}

.top-navbar{
background:linear-gradient(to right,#2c5352,#497379);
color:white;
padding:15px 25px;
}

.sidebar{
height:100vh;
background:linear-gradient(to bottom,#2c5352,#3f6f73);
padding-top:20px;
}

.sidebar a{
color:#e0f2f1;
padding:12px 20px;
display:block;
text-decoration:none;
}

.sidebar a:hover{
background:rgba(255,255,255,0.18);
}

.content-area{
padding:30px;
}

.card{
background:white;
padding:25px;
border-radius:12px;
}

</style>

</head>

<body>

<div class="top-navbar">
<h4>Medical Inventory Management System</h4>
</div>

<div class="container-fluid">

<div class="row">

<div class="col-md-2 sidebar p-0">

<a href="medicine.php">Medicines</a>
<a href="supplier.php">Suppliers</a>
<a href="stock.php">Stock In</a>
<a href="sales.php">Sales</a>
<a href="View-stock.php">View Stock</a>

</div>

<div class="col-md-10 content-area">

<a href="purchaseform.php" class="btn btn-primary mb-3">Add Purchase</a>

<div class="card">

<h4>Purchase List</h4>

<table class="table table-bordered">

<tr>

<th>Medicine</th>
<th>Supplier</th>
<th>Batch</th>
<th>Expiry</th>
<th>Quantity</th>
<th>Price</th>
<th>Edit</th>
<th>Delete</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?php echo $row['medicine_name']; ?></td>
<td><?php echo $row['supplier']; ?></td>
<td><?php echo $row['batch_no']; ?></td>
<td><?php echo $row['expiry_date']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td><?php echo $row['purchase_price']; ?></td>

<td>
<a href="purchaseform.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
Edit
</a>
</td>

<td>
<a href="stock.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
Delete
</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</div>

</body>

</html>