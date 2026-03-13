<?php
$host="localhost";
$uname="root";
$pwd="";
$dbname="medical_inventory";

$conn=mysqli_connect($host,$uname,$pwd,$dbname);

if(!$conn){
die("Connection failed: ".mysqli_connect_error());
}

$edit=false;

if(isset($_GET['id'])){
$edit=true;
$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM supplier_form WHERE id=$id");
$row=mysqli_fetch_assoc($result);
}

if(isset($_POST['submit'])){

$supplier_name=$_POST['supplier_name'];
$phone=$_POST['phone'];
$email=$_POST['email'];

if(isset($_POST['id'])){

$id=$_POST['id'];

$sql="UPDATE supplier_form SET
supplier_name='$supplier_name',
phone='$phone',
email='$email'
WHERE id=$id";

}else{

$sql="INSERT INTO supplier_form
(supplier_name,phone,email)
VALUES
('$supplier_name','$phone','$email')";
}

mysqli_query($conn,$sql);

header("Location: supplier.php");
exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Supplier Form</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
font-family:'Segoe UI';
background:#f8f9fa;
}

/* PAGE CONTAINER */

.page-container{
max-width:900px;
margin:60px auto;
}

/* TITLE */

.page-title{
font-size:28px;
font-weight:600;
margin-bottom:25px;
}

/* FORM SPACING */

.form-control{
height:45px;
margin-bottom:20px;
}

/* BUTTON */

.btn-main{
background:#2c5352;
color:white;
}

</style>

</head>

<body>

<div class="container page-container">

<h2 class="page-title">
<?php echo $edit ? "Edit Supplier" : "Add Supplier"; ?>
</h2>

<form method="POST">

<?php if($edit){ ?>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<?php } ?>

<label>Supplier Name</label>
<input type="text" name="supplier_name" class="form-control"
value="<?php echo $edit ? $row['supplier_name'] : ''; ?>" required>

<label>Phone</label>
<input type="text" name="phone" class="form-control"
value="<?php echo $edit ? $row['phone'] : ''; ?>" required>

<label>Email</label>
<input type="email" name="email" class="form-control"
value="<?php echo $edit ? $row['email'] : ''; ?>" required>

<button type="submit" name="submit" class="btn btn-main">
<?php echo $edit ? "Update Supplier" : "Save Supplier"; ?>
</button>

<a href="supplier.php" class="btn btn-secondary">Cancel</a>

</form>

</div>

</body>
</html>