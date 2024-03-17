<?php
session_start();
include '../connect.php';
if (!isset($_SESSION['user_name'])) {
  header("location:../index.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saint anne</title>
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/css/all.min.css">
    <script src="../resources/js/all.min.js"></script>
    <script src="../resources/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <script src="../resources/js/jquery.min.js"></script>
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
            <div class="col-sm-9">
              <div class="row m-2 p-4 ms-2">
                <div class="col-sm-3 bg-dark text-white p-5 rounded m-2 ms-3">Products  <?php
                  $select_no_prod=$conn->query("SELECT count(product_id) AS prod_no FROM products");
                  foreach($select_no_prod as $prod_no){
                ?><br><?=$prod_no['prod_no']; }?><br><a href="products.php" class="nav-link mt-2">View all&nbsp;<i class="fa-solid fa-arrow-right"></i></a></div>
                <div class="col-sm-3 bg-success p-5 rounded  text-white m-2">Total Stock in<br><?php $num=$conn->query("SELECT count(stock_in_id) AS 'total' FROM stock_in ");
                foreach ($num as $stock) {
                  echo $stock['total'];
                } ?><br><a href="stock_in.php" class="nav-link">View all&nbsp;<i class="fa-solid fa-arrow-right"></i></a></div>
                <div class="col-sm-3 bg-danger p-5 rounded text-white m-2">Total Stock outs<br><?php $num=$conn->query("SELECT count(stock_out_id) AS 'total' FROM stock_out ");
                foreach ($num as $stock) {
                  echo $stock['total'];
                } ?><br><a href="stock_out.php" class="nav-link mt-2" >View all&nbsp;<i class="fa-solid fa-arrow-right"></i></a></div>
               
              </div>
              <div class="card">
                <div class="card-header">
                <center><div><i class="fa-solid   fa-clock-rotate-left"></i>&nbsp;
                <b>Stock Status </b> </div></center>
                </div>
                <div class="card-body">
                <div class="table-responsivex">
                <table class="table table-striped table-hover table-sm border">
                    <thead class="bg-danger text-white">
                        <tr>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Price per kg</th>
                        <th class='text-center'>Amount in stock</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $select_stock_in=$conn->query("SELECT stock_in.*, products.product_name, products.unit_price from stock_in INNER JOIN products ON stock_in.product_id = products.product_id   order by stock_in.stock_in_date  desc LIMIT 5");
                        foreach ($select_stock_in as $row) {
                         
                           echo" <tr>
                         
                            <td class='text-center'>".$row['product_name']."</td>
                            <td class='text-center'>".$row['unit_price']." frw</td>
                            <td colspan='2' class='text-center'>".$row['quantity']." kg</td>
                         
                        </tr>";
                        }
                        ?>
                    </tbody>
                    <tr>
                    
                  </table>
                 
             </div>
                </div>
              </div>
           
             
            </div>
        </div>
  
</body>
</html>