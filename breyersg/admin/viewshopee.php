<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    include ("../connection.php");

$msg = "";

if (isset($_GET["delete_id"])){
        
    $qry = mysqli_query($con, "DELETE FROM online WHERE online_id ='" .mres($con, $_GET["delete_id"])."'");

    if($qry){
        $msg='<div id="login-alert" class="alert alert-success col-sm-12">Success! Data was Deleted</div>';
    }else{
        $msg='<div id="login-alert" class="alert alert-danger col-sm-12">Failure! Cannot Delete from Database</div>';
        }
    }

?>
        <?php include ("header2.php"); ?>
         <div class="row" style="padding-left: 0px; padding-right: 0px;">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                <div class="col-md-12">
             <?php include ("leftmenu.php"); ?>
                </div>
          </div>
          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
              <div class="col-md-12">
              <div class="well">
                    <div class="panel panel-primary">   
                      <div class="panel-heading">Shopee Delivery Log</div>
                      <div class="panel-body">
                          <?php echo $msg; ?>
                          <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="table_shopee">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Plat No.</th>
                            <th>Customer's Name</th>
                            <th>Address</th>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                            </thead>
                            <tbody>
                       <?php
                        $qry = "";
                        
                        $qry = mysqli_query($con, "SELECT * FROM online WHERE platform = 'Shopee'  ORDER BY online_id desc");   
                        while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                            ?>
                            <tr>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['no_plat'] ?></td>
                                <td><?php echo $row['nama_pelanggan'] ?></td>
                                <td><?php echo $row['alamat'] ?></td>
                                <td><?php echo $row['jenama'] ?></td>
                                <td><?php echo $row['jenis'] ?></td>
                                <td><?php echo $row['kuantiti'] ?></td>
                                <td><?php echo $row['tarikh'] ?></td>
                                <?php
                                
                                    echo "<td><a href='?delete_id=".$row["online_id"]."' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a></td>";
                                
                                ?>
                            </tr>
                            </tbody>
                            <?php
                        }
                        ?>
                </table>
                        </div>
                    </div>
              </div>
        </div>
    </div>
</div>
             </div>
<script type="text/javascript" charset="utf8" src="../DataTables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="../DataTables/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#table_shopee').DataTable();
            });
</script>