<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header("location:../index.php");
}
include '../connect.php';
if(isset($_POST['update'])){
    $id=$_GET['id'];
    $pname=$_POST['pname'];
    $price=$_POST['price'];
    $update=$conn->query("UPDATE products SET product_name='$pname', unit_price='$price' WHERE product_id='$id'");   
    if($update){
     header("location:products.php");
    }
    else{
      header("location:edit.php?error=product not Edited&id=".$id);
   
    }
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
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon">
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
      
            <div class="col-sm-8 mt-3 mx-auto">
              <div class="row m-2 p-4 ms-7 justify-content-center align-items-center ">
                <?php
                if (isset($_GET['id'])) {
                    $id=$_GET['id'];
                    $prod=$conn->query("SELECT * FROM products  WHERE product_id='$id'");
                    while ($row =$prod->fetch_assoc()) {
                        $product_name=$row['product_name'];
                        $unit_price=$row['unit_price'];

                
                ?>
            <div class="card">
              <div class="card-header"> <center><div><i class="fa-solid fa-cart-plus"></i>&nbsp;Edit </div></center></div>
              <div class="card-body">
              <div class="col-sm-12 ">
               
               <form method="post" class=" p-3 mt-2">
               <?php
                   if(isset($_GET['error'])){
                      $error=$_GET['error'];
                      echo'<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      '.$error.'
                    </div>';
                   }
                   ?>
                   <div class="input-group mb-3">
                       <span class="input-group-text"><i class="fa-solid fa-cart-shopping"></i>&nbsp; Product name:</span>
                       <input type="text" placeholder="Enter product name"name="pname" class="form-control " value="<?= $product_name ?>">
                   </div>
                   <div class="input-group mb-3">
                       <span class="input-group-text"><i class="fa-solid fa-money-bill"></i>&nbsp;Unit price: </span>
                       <input type="text" placeholder="Enter product price per kg..." name="price" class="form-control " value="<?= $unit_price ?>">
                   </div>
                   
                   <center><button type="submit" name="update" class="btn btn-danger btn-sm col-5"><i class="fa-solid fa-pen"></i>&nbsp;Update</button></center>
               </form>
            </div>
            <?php
                 }
                } 
            ?>
              </div>
            </div>
          
            </div>
        </div>
    </div>
</body>
</html>