<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Medical Inventory Dashboard</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(to right,#e0f7f6,#f4f9f9);
    overflow-x:hidden;
}

.top-border{
    height:6px;
    background:linear-gradient(to right,#2c5352,#497379,#6fb1a0);
}

.top-navbar{
    background:linear-gradient(to right,#2c5352,#497379);
    color:white;
    padding:15px 25px;
    box-shadow:0 6px 15px rgba(0,0,0,0.15);
}

.top-navbar .brand{
    font-weight:600;
    font-size:20px;
}

.logout-btn{
    background:white;
    color:#2c5352;
    border-radius:8px;
    border:none;
    padding:6px 14px;
    font-weight:500;
}
.logout-btn a{color:#2c5352;text-decoration:none;}
.logout-btn:hover{background:#e6f2f1;}

/* Sidebar */
.sidebar{
    min-height:100vh;
    background:linear-gradient(to bottom,#2c5352,#3f6f73);
    padding-top:20px;
    position:relative;
}
.sidebar::after{
    content:"";
    position:absolute;
    top:0;
    right:0;
    width:2px;
    height:100%;
    background:linear-gradient(to bottom,transparent,rgba(255,255,255,0.4),transparent);
}
.sidebar a{
    color:#e0f2f1;
    padding:12px 20px;
    display:block;
    text-decoration:none;
    transition:0.3s;
}
.sidebar a:hover,
.sidebar a.active{
    background:rgba(255,255,255,0.18);
    color:white;
    border-left:4px solid #a7ffeb;
}

/* Content */
.content-area{
    padding:30px;
    padding-bottom:10px;
}

.dashboard-card{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.dashboard-card i{
    font-size:35px;
    opacity:0.8;
}

.chart-card{
    background:white;
    padding:10px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.icon-blue{color:#0d6efd;}
.icon-grey{color:#6c757d;}
.icon-yellow{color:#ffc107;}
.icon-green{color:#198754;}
.icon-red{color:#dc3545;}

canvas{
    max-width:250px;
    margin:auto;
}

/* FIX EXTRA SPACE */
.table{margin-bottom:0;}
.card:last-child{margin-bottom:0;}
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
        <button class="logout-btn ms-3">
            <a href="loginpg.html">Logout</a>
        </button>
    </div>
</div>

<div class="container-fluid">
<div class="row">

<!-- Sidebar -->
<div class="col-md-2 sidebar p-0">
   <a href="medicine.php"><i class="bi bi-capsule me-2"></i> Medicines</a>
    <a href="supplier.php"><i class="bi bi-truck me-2"></i> Suppliers</a>
    <a href="stock.php"><i class="bi bi-box-arrow-in-down me-2"></i> Stock In</a>
    <a href="sales.php" class="active"><i class="bi bi-cart me-2"></i> Sales</a>
    <a href="view-stock.php"><i class="bi bi-box-seam me-2"></i> View Stock</a>
</div>

<!-- Main Content -->
<div class="col-md-10 content-area">

<!-- Top Cards -->
<div class="row g-4 mb-3">
    <div class="col-md-4">
        <div class="dashboard-card">
            <div>
                <h6>Total Medicines</h6>
                <h3 class="text-primary">15</h3>
            </div>
            <i class="bi bi-capsule icon-blue"></i>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card">
            <div>
                <h6>Total Batches</h6>
                <h3 class="text-secondary">28</h3>
            </div>
            <i class="bi bi-box-seam icon-grey"></i>
        </div>
    </div>

    <div class="col-md-4">
        <div class="dashboard-card">
            <div>
                <h6>Low Stock Items</h6>
                <h3 class="text-warning">4</h3>
            </div>
            <i class="bi bi-exclamation-triangle icon-yellow"></i>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row g-4 mb-3">
    <div class="col-md-6">
        <div class="chart-card text-center">
            <h5 class="mb-3">Stock Overview</h5>
            <canvas id="pieChart1"></canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div class="chart-card text-center">
            <h5 class="mb-3">Stock Status</h5>
            <canvas id="pieChart2"></canvas>
        </div>
    </div>
</div>

<!-- Transactions -->
<div class="card shadow-sm">
<div class="card-body">
<h5 class="mb-3">Recent Transactions</h5>

<div class="table-responsive">
<table class="table table-bordered align-middle">
<thead class="table-light">
<tr>
<th>Date</th>
<th>Transaction Type</th>
<th>Medicine Name</th>
<th>Quantity</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<tr>
<td>05-04-2024</td>
<td class="text-success fw-semibold">Stock In</td>
<td>Paracetamol</td>
<td class="text-success">+100</td>
<td><span class="badge bg-primary">Received</span></td>
</tr>
<tr>
<td>05-04-2024</td>
<td class="text-danger fw-semibold">Sales</td>
<td>Amoxicillin</td>
<td class="text-danger">-20</td>
<td><span class="badge bg-warning text-dark">Low Stock</span></td>
</tr>
<tr>
<td>05-04-2024</td>
<td class="text-danger fw-semibold">Sales</td>
<td>Ibuprofen</td>
<td class="text-danger">-5</td>
<td><span class="badge bg-danger">Expired</span></td>
</tr>
<tr>
<td>05-04-2024</td>
<td class="text-success fw-semibold">Stock In</td>
<td>Cough Syrup</td>
<td class="text-success">+50</td>
<td><span class="badge bg-primary">Received</span></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('pieChart1'),{
    type:'pie',
    data:{
        labels:['Tablets','Syrups','Injection','Others'],
        datasets:[{
            data:[60,20,12,8],
            backgroundColor:['#0d6efd','#ffc107','#198754','#dc3545']
        }]
    }
});

new Chart(document.getElementById('pieChart2'),{
    type:'doughnut',
    data:{
        labels:['In Stock','Expired','Low Stock'],
        datasets:[{
            data:[65,15,20],
            backgroundColor:['#198754','#dc3545','#ffc107']
        }]
    }
});
</script>

</body>
</html>