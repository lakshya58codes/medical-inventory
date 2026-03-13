<?php
$host = "localhost";
$uname = "root";
$pwd   = "";
$dbname = "medical_inventory";

$conn = mysqli_connect($host, $uname, $pwd, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch sales history
$result = mysqli_query($conn, "SELECT * FROM saleshistory ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sales History</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right, #e0f7f6, #f4f9f9);
}
.top-border {
    height: 6px;
    background: linear-gradient(to right, #2c5352, #497379, #6fb1a0);
}
.top-navbar {
    background: linear-gradient(to right, #2c5352, #497379);
    color: white;
    padding: 15px 25px;
}
.sidebar {
    height: 100vh;
    background: linear-gradient(to bottom, #2c5352, #3f6f73);
    padding-top: 20px;
}
.sidebar a {
    color: #e0f2f1;
    padding: 12px 20px;
    display: block;
    text-decoration: none;
}
.sidebar a:hover,
.sidebar a.active {
    background: rgba(255,255,255,0.18);
    border-left: 4px solid #a7ffeb;
}
.content-area {
    padding: 30px;
}
.custom-card {
    background: rgba(255,255,255,0.95);
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}
.table thead {
    background: #f1f5f4;
}
.btn-primary {
    background: linear-gradient(to right, #2c5352, #497379);
    border: none;
}
</style>
</head>

<body>

<div class="top-border"></div>

<div class="top-navbar d-flex justify-content-between align-items-center">
    <div class="brand">
        <i class="bi bi-hospital"></i> Medical Inventory Management System
    </div>
    <div>
        Welcome, Admin
        <a href="loginpg.php" class="btn btn-light btn-sm ms-3">Logout</a>
    </div>
</div>

<div class="container-fluid">
<div class="row">

<div class="col-md-2 sidebar p-0">
    <a href="medicine.php">Medicines</a>
    <a href="supplier.php">Suppliers</a>
    <a href="stock.php">Stock In</a>
    <a href="sales.php" class="active">Sales</a>
    <a href="view-stock.php">View Stock</a>
</div>

<div class="col-md-10 content-area">

<h3 class="mb-3">Sales History</h3>

<div class="custom-card">

<div class="table-responsive">
<table class="table table-bordered align-middle">

<thead>
<tr>
    <th>Sale ID</th>
    <th>Invoice No</th>
    <th>Customer</th>
    <th>Date</th>
    <th>Total Amount</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['invoice_no']}</td>
            <td>{$row['customer']}</td>
            <td>" . date('d-m-Y', strtotime($row['date'])) . "</td>
            <td>₹{$row['total']}</td>
            <td>
                <button class='btn btn-sm btn-primary'>View</button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No Sales Found</td></tr>";
}
?>

</tbody>
</table>
</div>

</div>
</div>
</div>
</div>

</body>
</html>