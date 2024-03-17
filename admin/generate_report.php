<?php
include '../connect.php';
if (isset($_POST['from']) && $_POST['to']) {
    $date1=$_POST['from'];
    $date2=$_POST['to'];

                         $stock_in=$conn->query("SELECT products.product_name ,stock_in.quantity,stock_in.stock_in_date FROM stock_in 
                         LEFT JOIN products ON stock_in.product_id=products.product_id WHERE stock_in.stock_in_date BETWEEN '$date1'AND '$date2'");
                         $stock_out=$conn->query("SELECT products.product_name ,stock_out.quantity,stock_out.stock_out_date FROM stock_out
                         LEFT JOIN products ON stock_out.product_id=products.product_id WHERE stock_out.stock_out_date BETWEEN '$date1'AND '$date2';"); 
                         if (mysqli_num_rows($stock_in)>0) {
                               while ($row=mysqli_fetch_assoc($stock_in)) {
                                   $p_name= $row["product_name"];
                                   $quantity= $row["quantity"];
                                   $date=$row["stock_in_date"];
                                   echo "<tr>
                                   <td>Stock in</td>
                                   <td>".$p_name."</td>
                                    <td>".$quantity."</td>
                                    <td>".$date."</td>
                                   </tr>";
                               }
                          }
                          if (mysqli_num_rows($stock_out)>0) {
                            while ($row=mysqli_fetch_assoc($stock_out)) {
                                $p_name= $row["product_name"];
                                $quantity= $row["quantity"];
                                $date=$row["stock_out_date"];
                                echo "<tr>
                                <td>Stock out</td>
                                <td>".$p_name."</td>
                                 <td>".$quantity."</td>
                                 <td>".$date."</td>
                                </tr>";
                            }
                       }
                        if((mysqli_num_rows($stock_in)==0) OR(mysqli_num_rows($stock_out)==0)){
                          echo "<tr><td colspan='4'><center>No operations found in given date</center></td></tr>";
                        }
                    }