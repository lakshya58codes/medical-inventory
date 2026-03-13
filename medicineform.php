<?php
$conn = mysqli_connect("localhost","root","","medical_inventory");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

$edit = false;

if(isset($_GET['id'])){
    $edit = true;
    $id = $_GET['id'];

    $result = mysqli_query($conn,"SELECT * FROM medicineform WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
}

if(isset($_POST['submit'])){

    $medicine_name  = $_POST['medicine_name'];
    $category       = $_POST['category'];
    $purchase_price = $_POST['purchase_price'];
    $selling_price  = $_POST['selling_price'];
    $quantity       = $_POST['quantity'];
    $expiry         = $_POST['expiry'];

    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $sql = "UPDATE medicineform SET
                medicine_name='$medicine_name',
                category='$category',
                purchase_price='$purchase_price',
                selling_price='$selling_price',
                quantity='$quantity',
                expiry='$expiry'
                WHERE id=$id";

    } else {

        $sql = "INSERT INTO medicineform
                (medicine_name, category, purchase_price, selling_price, quantity, expiry)
                VALUES
                ('$medicine_name','$category','$purchase_price','$selling_price','$quantity','$expiry')";
    }

    $result = mysqli_query($conn,$sql);

    if($result){
        header("Location: medicine.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $edit ? "Edit Medicine" : "Add Medicine"; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
background: linear-gradient(to right,#e0f7f6,#f4f9f9);
font-family:'Segoe UI';
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

.btn-update{
background:#2c5352;
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

<div class="custom-card">

<h4><?php echo $edit ? "Edit Medicine" : "Add Medicine"; ?></h4>

<form method="POST">

<?php if($edit){ ?>
<input type="hidden" name="id" value="<?= $row['id']; ?>">
<?php } ?>

<div class="mb-3">
<label>Medicine Name</label>
<input type="text" name="medicine_name" class="form-control"
value="<?= $edit ? $row['medicine_name'] : '' ?>" required>
</div>

<div class="mb-3">
<label>Category</label>
<input type="text" name="category" class="form-control"
value="<?= $edit ? $row['category'] : '' ?>" required>
</div>

<div class="mb-3">
<label>Purchase Price</label>
<input type="number" name="purchase_price" class="form-control"
value="<?= $edit ? $row['purchase_price'] : '' ?>" required>
</div>

<div class="mb-3">
<label>Selling Price</label>
<input type="number" name="selling_price" class="form-control"
value="<?= $edit ? $row['selling_price'] : '' ?>" required>
</div>

<div class="mb-3">
<label>Quantity</label>
<input type="number" name="quantity" class="form-control"
value="<?= $edit ? $row['quantity'] : '' ?>" required>
</div>

<div class="mb-3">
<label>Expiry Date</label>
<input type="date" name="expiry" class="form-control"
value="<?= $edit ? $row['expiry'] : '' ?>" required>
</div>

<button type="submit" name="submit" class="btn btn-update">
<?php echo $edit ? "Update Medicine" : "Save Medicine"; ?>
</button>

<a href="medicine.php" class="btn btn-secondary">Cancel</a>

</form>

</div>

</div>
</div>
</div>

</body>
</html>