<?php
include 'connect.php';
session_start();
if(isset($_POST['submit'])){
   $uname=$_POST['uname'];
   $pass=$_POST['pass'];
   $select=$conn->query("SELECT * FROM users WHERE user_name='$uname' AND password='$pass'");
   if(mysqli_num_rows($select)>0){
    $_SESSION['user_name']=$uname;
    header("location:admin/index.php");

   }
   else{
    header("location:index.php?error=invalid username or password");
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saint anne</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/all.min.css">
    <script src="resources/js/all.min.js"></script>
    <script src="resources/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="images/logo.jpg" type="image/x-icon">
</head>
<body>
<div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-3">

            </div>
            <div class="col-sm-5 mt-5 border rounded p-5 ms-5">
                  <div class="nav-brand">
               <center><img src="images/user.jpg" alt="Avatar Logo" style="width:120px;" class="rounded-pill"> </center>   
                  </div>
                <form method="post">
                    <?php
                    if(isset($_GET['error'])){
                       $error=$_GET['error'];
                       echo'<div class="alert alert-warning alert-dismissible">
                       <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                       Invalid username or password
                     </div>';
                    }
                    ?>
                    <div class="input-group mt-3">
                        <span class="input-group-text">
                          <b> <i class="fa-solid fa-user-tie "></i></b>
                        </span>
                        <input type="text" name="uname" class="form-control" placeholder="Enter username" required>
                    </div>
                    <div class="input-group mt-3">
                        <span class="input-group-text">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="pass" class="form-control" placeholder="Enter password" required>
                    </div>
                   <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox"  checked>
                        <label class="form-check-label">Remember Me</label>
                      </div>

                  <center><button type="submit" name="submit"  class="btn btn-danger btn-sm col-5 "><i class="fa-solid fa-right-to-bracket"></i>&nbsp; &nbsp;SIGNIN</button></center>  
                </form>
            </div>
        </div>
    </div> 
</body>
</html>