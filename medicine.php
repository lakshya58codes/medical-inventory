<?php
$conn = mysqli_connect("localhost","root","","medical_inventory");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['delete'])){
$delete_id = $_GET['delete'];

$delete_query = "DELETE FROM medicineform WHERE id=$delete_id";
mysqli_query($conn,$delete_query);

header("Location: medicine.php");
exit();
}

$query = "SELECT * FROM medicineform";
$data = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Medical Inventory Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
margin:0;
font-family:'Segoe UI';
background:linear-gradient(to right,#e0f7f6,#f4f9f9);
}

.top-border{
height:6px;
background:linear-gradient(to right,#2c5352,#497379,#6fb1a0);
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

.sidebar a:hover,
.sidebar a.active{
background:rgba(255,255,255,0.18);
color:white;
}

.content-area{
padding:30px;
}

.custom-card{
background:white;
border-radius:12px;
padding:25px;
}

.btn-add{
background:#2c5352;
color:white;
}

.btn-edit{
background:#2c5352;
color:white;
}

.btn-delete{
background:red;
color:white;
}

</style>

</head>

<body>

<div class="top-border"></div>

<div class="top-navbar d-flex justify-content-between">
<div><i class="bi bi-hospital"></i> Medical Inventory Management</div>
<div><a href="loginpg.php" class="btn btn-light">Logout</a></div>
</div>

<div class="container-fluid">
<div class="row">

<div class="col-md-2 sidebar">
<a href="medicine.php" class="active"><i class="bi bi-capsule me-2"></i> Medicines</a>
<a href="supplier.php"><i class="bi bi-truck me-2"></i> Suppliers</a>
<a href="stock.php"><i class="bi bi-box-arrow-in-down me-2"></i> Stock In</a>
<a href="sales.php"><i class="bi bi-cart me-2"></i> Sales</a>
<a href="view-stock.php"><i class="bi bi-box-seam me-2"></i> View Stock</a>
</div>

<div class="col-md-10 content-area">

<a href="medicineform.php" class="btn btn-add mb-3">
<i class="bi bi-plus-lg"></i> Add Medicine
</a>

<div class="custom-card">

<h4 class="mb-3">Medicine List</h4>

<table class="table table-bordered text-center align-middle">

<thead class="table-light">

<tr>
<th>ID</th>
<th>Name</th>
<th>Category</th>
<th>Purchase</th>
<th>Selling</th>
<th>Quantity</th>
<th>Expiry</th>
<th>Edit</th>
<th>Delete</th>
</tr>

</thead>

<tbody>

<?php
if(mysqli_num_rows($data)>0){

while($row=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $row['id']; ?></td>
<td><?= $row['medicine_name']; ?></td>
<td><?= $row['category']; ?></td>
<td><?= $row['purchase_price']; ?></td>
<td><?= $row['selling_price']; ?></td>
<td><?= $row['quantity']; ?></td>
<td><?= $row['expiry']; ?></td>

<td>
<a href="medicineform.php?id=<?= $row['id']; ?>" class="btn btn-edit btn-sm">
Edit
</a>
</td>

<td>
<a href="medicine.php?delete=<?= $row['id']; ?>" class="btn btn-delete btn-sm"
onclick="return confirm('Delete this medicine?')">
Delete
</a>
</td>

</tr>

<?php
}
}
else{
echo "<tr><td colspan='9'>No Data Found</td></tr>";
}
?>

</tbody>

</table>

</div>

</div>
</div>
</div>

</body>
</html>