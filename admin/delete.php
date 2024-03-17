<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header("location:../index.php");
}
include'../connect.php';
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $delete=$conn->query("DELETE FROM products where product_id='$id'");
    if ($delete) {
        header("location:products.php");
        }
}
else {
    header("location:products.php");
}
 ?>