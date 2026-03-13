<?php

$conn=mysqli_connect("localhost","root","","medical_inventory");

$id="";
$medicine="";
$supplier="";
$batch="";
$expiry="";
$qty="";
$price="";

/* EDIT DATA FETCH */

if(isset($_GET['id'])){

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM purchaseform WHERE id='$id'");
$row=mysqli_fetch_assoc($result);

$medicine=$row['medicine_name'];
$supplier=$row['supplier'];
$batch=$row['batch_no'];
$expiry=$row['expiry_date'];
$qty=$row['quantity'];
$price=$row['purchase_price'];
}

/* SAVE OR UPDATE */

if(isset($_POST['submit'])){

$id=$_POST['id'];

$medicine=$_POST['medicine_name'];
$supplier=$_POST['supplier'];
$batch=$_POST['batch_no'];
$expiry=$_POST['expiry_date'];
$qty=$_POST['quantity'];
$price=$_POST['purchase_price'];

if($id==""){

mysqli_query($conn,"INSERT INTO purchaseform
(medicine_name,supplier,batch_no,expiry_date,quantity,purchase_price)
VALUES
('$medicine','$supplier','$batch','$expiry','$qty','$price')");

}else{

mysqli_query($conn,"UPDATE purchaseform SET

medicine_name='$medicine',
supplier='$supplier',
batch_no='$batch',
expiry_date='$expiry',
quantity='$qty',
purchase_price='$price'

WHERE id='$id'");

}

header("Location: stock.php");
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Add Purchase</title>

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

<div class="card">

<h4>Add / Edit Purchase</h4>

<form method="POST">

<input type="hidden" name="id" value="<?php echo $id; ?>">

<div class="mb-3">
<label>Medicine</label>
<input type="text" name="medicine_name" class="form-control" value="<?php echo $medicine; ?>" required>
</div>

<div class="mb-3">
<label>Supplier</label>
<input type="text" name="supplier" class="form-control" value="<?php echo $supplier; ?>" required>
</div>

<div class="mb-3">
<label>Batch</label>
<input type="text" name="batch_no" class="form-control" value="<?php echo $batch; ?>" required>
</div>

<div class="mb-3">
<label>Expiry</label>
<input type="date" name="expiry_date" class="form-control" value="<?php echo $expiry; ?>" required>
</div>

<div class="mb-3">
<label>Quantity</label>
<input type="number" name="quantity" class="form-control" value="<?php echo $qty; ?>" required>
</div>

<div class="mb-3">
<label>Price</label>
<input type="number" name="purchase_price" class="form-control" value="<?php echo $price; ?>" required>
</div>

<button class="btn btn-primary" name="submit">Save</button>

</form>

</div>

</div>

</div>

</div>

</body>

</html>