<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "medical_inventory";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/* DELETE SUPPLIER */
if(isset($_GET['delete'])){
$id=$_GET['delete'];

mysqli_query($conn,"DELETE FROM supplier_form WHERE id=$id");

header("Location: supplier.php");
exit();
}
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
/* SAME CSS AS YOUR FILE */
body{margin:0;font-family:'Segoe UI';background:linear-gradient(to right,#e0f7f6,#f4f9f9);}
.top-border{height:6px;background:linear-gradient(to right,#2c5352,#497379,#6fb1a0);}
.top-navbar{background:linear-gradient(to right,#2c5352,#497379);color:white;padding:15px 25px;}
.logout-btn{background:white;color:#2c5352;border-radius:8px;border:none;padding:6px 14px;font-weight:500;}
.sidebar{height:100vh;background:linear-gradient(to bottom,#2c5352,#3f6f73);padding-top:20px;}
.sidebar a{color:#e0f2f1;padding:12px 20px;display:block;text-decoration:none;}
.sidebar a:hover,.sidebar a.active{background:rgba(255,255,255,0.18);color:white;border-left:4px solid #a7ffeb;}
.content-area{padding:30px;}
.custom-card{background:white;border-radius:16px;padding:28px;}
a{color:#2c5352;text-decoration:none;}
</style>
</head>

<body>

<div class="top-border"></div>

<div class="top-navbar d-flex justify-content-between align-items-center">
<div class="brand"><i class="bi bi-hospital"></i> Medical Inventory Management System</div>
<div>Welcome, Admin
<button class="logout-btn ms-3"><a href="loginpg.php">Logout</a></button>
</div>
</div>

<div class="container-fluid">
<div class="row">

<div class="col-md-2 sidebar p-0">
<a href="medicine.php"><i class="bi bi-capsule me-2"></i>Medicines</a>
<a href="supplier.php" class="active"><i class="bi bi-truck me-2"></i>Suppliers</a>
<a href="stock.php"><i class="bi bi-box-arrow-in-down me-2"></i>Stock In</a>
<a href="sales.php"><i class="bi bi-cart me-2"></i>Sales</a>
<a href="view-stock.php"><i class="bi bi-box-seam me-2"></i>View Stock</a>
</div>

<div class="col-md-10 content-area">

<button class="btn btn-primary mb-3">
<i class="bi bi-plus-lg"></i>
<a href="supplierform.php" style="color:white;">Add Supplier</a>
</button>

<div class="custom-card">

<h4 class="mb-4">Supplier List</h4>

<div class="table-responsive">

<table class="table table-bordered">

<thead>
<tr>
<th>Supplier Name</th>
<th>Phone</th>
<th>Email</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>

<tbody>

<?php
$result=mysqli_query($conn,"SELECT * FROM supplier_form ORDER BY id DESC");

while($row=mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['supplier_name']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['email']; ?></td>

<td>
<a href="supplierform.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
</td>

<td>
<a href="supplier.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete Supplier?')">Delete</a>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>
</div>
</div>
</div>
</div>

</body>
</html>