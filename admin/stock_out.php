<?php 
session_start();
if (!isset($_SESSION['user_name'])) {
  header("location:../index.php");
}
include '../connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/css/all.min.css">
    <script src="../resources/js/all.min.js"></script>
    <script src="../resources/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon">
    <title>Saint anne</title>
</head>
<body>
    
<div class="container-fluid">
<div class="row">
<div class="col-sm-3  pb-4  " id="nav" style="background-color:  #690108;">
            
            <div class="navbar-brand rounded ms-4 mt-2">
            <a href="index.php"><img src="../images/logo.png" alt="Avatar Logo" style="width: 160px;" class="rounded ms-4 "></a><br>
             
            <a class="navbar-brand text-white ms-4" href="index.php"><b class="text-lg">STOCK MANAGMENT</b><br><b class="ms-5">SYSTEM</b></a> 
            </div>
           <ul class="nav flex-column mt-5 mb-3 p-3 ">
            <li class="nav-item mb-2">
                <a class="nav-link text-light" href="index.php"><i class="fa-solid fa-gauge"></i>&nbsp;Dashboard</a>
              </li>
              <li class="nav-item  mb-2">
                <a class="nav-link text-light" href="products.php"><i class="fa-solid fa-cart-shopping"></i>&nbsp;View Products</a>
              </li>
              <li class="nav-item  mb-2">
                <a class="nav-link text-light" href="stock_in.php"><i class="fa-solid fa-cart-plus"></i>&nbsp;Stock in</a>
              </li>
              <li class="nav-item  mb-2">
                <a class="nav-link text-light" href="stock_out.php"><i class="fa-solid fa-cart-arrow-down"></i>&nbsp;Stock out</a>
              </li>
              <li class="nav-item  mb-2">
                <a class="nav-link text-light" href="report.php"><i class="fa-solid fa-file-contract"></i>&nbsp;Stock Report</a>
              </li>
              <div class="nav-brand ms-3  mt-3">
              <img src="../images/user.png" alt="Avatar Logo" style="width:100px;" class="rounded-pill"> 
              </div>
              <li class="nav-item text-light mb-3 ms-5 mt-2 ">
                <?= $_SESSION['user_name']?>
              </li>
              <li class="nav-item  mb-2 mt-2 ">
                <button class="btn text-white"  data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa-solid fa-power-off"></i>&nbsp;Logout</button>
              </li>
           </ul>
                      <!-- The Modal -->
<div class="modal modal-fade" id="myModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Saint Anne Managment <b class="text-danger">SYSTEM</b></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body">
   <i class="fa-solid fa-question text-danger me-2" style="font-size:30px" ></i>  Logout  Already
  </div>
  <div class="modal-footer d-flex justify-content-center">
    <button type="button" class="btn btn-danger btn-sm col-4" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i>&nbsp;No</button>
    <a  class="btn btn-primary btn-sm col-4" href="logout.php"><i class="fa-solid fa-power-off"></i>&nbsp;Yes</a>
  </div>
</div>
</div>
</div>
</div>
      
            <div class="col-sm-8 mt-3">
             <div class="card">
              <div class="card-header"><center><i class="fa-solid fa-cart-plus"></i>&nbsp;stock in</</center></div>
              <div class="card-body">
              <div class="table-responsive  ">
                <table class="table table-striped table-hover">
                    <thead class="bg-danger text-light">
                        <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Price per kg</th>
                        <th>Quantity in kg</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                
                    <?php
                        $select_stock_out=$conn->query("SELECT stock_out.*, products.product_name, products.unit_price from stock_out INNER JOIN products ON stock_out.product_id = products.product_id   order by stock_out.stock_out_date  DESC");
                        foreach ($select_stock_out as $row) {
                         
                           echo" <tr>
                            <td>".$row['product_id']."</td>
                            <td>".$row['product_name']."</td>
                            <td>".$row['unit_price']." frw</td>
                            <td>".$row['quantity']." kg</td>
                            <td>".$row['stock_out_date']."</td>
                        </tr>";
                        }
                        ?>
                    
                    </tbody>
                    <tr>
                    
                  </table>
                  <center><a href="new_stockout.php" class="btn btn-danger  col-5 btn-sm"><i class="fa-solid fa-plus  "></i>&nbsp;New stock out</a></center>
             </div>  
              </div>
             </div>
             
            </div>
        </div>
    </div>
</body>
</html>