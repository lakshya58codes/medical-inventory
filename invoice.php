<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background:#f4f9f9;
    padding:40px;
}

.invoice-box {
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.invoice-header {
    display:flex;
    justify-content:space-between;
    margin-bottom:30px;
}

@media print {
    .print-btn {
        display:none;
    }
    body {
        background:white;
        padding:0;
    }
}
</style>
</head>

<body>

<div class="container">
<div class="invoice-box">

<div class="invoice-header">
    <div>
        <h4>Medical Store</h4>
        <p>123 Main Street<br>City, India</p>
    </div>
    <div>
        <h5>Invoice</h5>
        <p>Invoice No: Auto-001<br>Date: 05-04-2024</p>
    </div>
</div>

<hr>

<h6>Customer: Walk In</h6>

<table class="table table-bordered mt-3">
<thead>
<tr>
    <th>Medicine</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Total</th>
</tr>
</thead>
<tbody>
<tr>
<td>Paracetamol</td>                                                                    
    <td>5</td>
    <td>50</td>
    <td>250</td>
</tr>
<tr>
    <td>Vitamin C</td>
    <td>10</td>
    <td>50</td>
    <td>500</td>
</tr>
</tbody>
</table>

<div class="text-end">
    <h5>Grand Total: ₹750</h5>
</div>

<div class="text-center mt-4">
    <button onclick="window.print()" class="btn btn-success print-btn">
        Print / Download PDF
    </button>
</div>

</div>
</div>

</body>
</html>