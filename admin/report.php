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
    <title>Saint anne</title>
    <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/css/all.min.css">
    <script src="../resources/js/all.min.js"></script>
    <script src="../resources/js/bootstrap.bundle.min.js"></script>
    <script src="../resources/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
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
            <div class="col-sm-9 mt-3 mx-auto">
              <div class="row m-2 p-4 ms-7 justify-content-center align-items-center ">
            <div class="card">
              <div class="card-header"> <center><i class="fa-solid fa-file-contract"></i>&nbsp;Stock Report</div>
              <div class="card-body">
              <div class="row ">
                <div class="col-sm-4">
                <div class="input-group">
                  <span class="input-group-text">
                   <i class="fa-solid fa-calendar-days"></i>&nbsp;  From:
                  </span>
                  <input type="date" class="form-control" id="from">
                </div>
                </div>
                <div class="col-sm-4">
                <div class="input-group">
                  <span class="input-group-text">
                  <i class="fa-solid fa-calendar-days"></i>&nbsp; To:
                  </span>
                  <input type="date" class="form-control" id="to">
                </div>
                  </div>
                  <div class="col-sm-4">
                  <button type="button" id="btn" class="btn btn-danger btn-sm col-5"><i class="fa-solid fa-file-pdf"></i>Get report</button>
                </div>
                <div class="row mx-auto mt-2">
                <div class="col-sm-12 ">
                   <div class="table-responsive " id="content">
                    <table class="table table-stripped table-hover border ">
                       <thead class="bg-danger text-white">
                          <th>Operation</th>
                          <th>Product name</th>
                          <th>Quantity</th>
                          <th>Date</th>
                       </thead>
                       <tbody id="body">
      
                       </tbody>

                    </table>
                   </div>
                 <center><button type="button" onclick="downloadPDF()" class="btn btn-danger btn-sm col-5" > <i class="fa-solid fa-file-arrow-down" ></i>&nbsp; Download</button></center>  
                 </div>
                </div>
              
              </div>
            </div>
            </div>
        </div>
    </div>
</body>
<script>
  
function downloadPDF() {
    const element = document.getElementById('content');
    const filename = 'report.pdf'; // Set your desired file name here
    const opt = {
        filename: filename,
        margin: 0,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf()
        .from(element)
        .set(opt)
        .save();
}

  $(document).ready(()=>{
   $("#btn").click(()=>{
    let from=$("#from").val();
    let to=$("#to").val();
    $.post("generate_report.php",{from:from,to:to},(data,status)=>{
      $("#body").html(data);
    });
   })
  });
</script>
</html>