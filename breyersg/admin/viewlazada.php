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
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                <div class="col-md-12">
             <?php include ("leftmenu.php"); ?>
          </div>
             </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
              <div class="col-md-12">
                  <div class="well">
                  <form method="post" class="form-inline" id="form-search" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                  <div class="form-group">
                          <label>Search By Plat No.:</label>
                           <input type="text" class="form-control" name="search_text" id="search_text">
                           <button type="submit" class="btn btn-default" id="btn_search" name="btn_search">Search</button>
                        </div>
                  </form>
              </div>
              <div class="well">
                    <div class="panel panel-primary">
                      <div class="panel-heading">Lazada Delivery Log</div>
                      <div class="panel-body">
                          <?php echo $msg; ?>
                          <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="table_lazada">
                    <thead>
                        <tr>
                            <th>Driver Name</th>
                            <th>DO Number</th>
                            <th>Customer ID</th>
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
                        
                        $qry = mysqli_query($con, "SELECT online.online_id, online.username, online.tarikh, online.do_number, online.customer_id, online.nama_pelanggan, online.alamat, online.jenama, online.jenis, online.kuantiti, online.jenama_2, online.jenis_2, online.kuantiti_2, online.jenama_3, online.jenis_3, online.kuantiti_3, online.platform, online.active, online.status, jenama.jenama, jenis.jenis FROM online INNER JOIN jenama ON online.jenama = jenama.jenama_id INNER JOIN jenis ON online.jenis = jenis.jenis_id WHERE online.status = 1 AND online.platform = 'Lazada' ORDER BY online.tarikh DESC");   
                        while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                            ?>
                            <tr>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['do_number'] ?></td>
                                <td><?php echo $row['customer_id'] ?></td>
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
                                <tr>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td><?php echo $row['jenama_2'] ?></td>
                                <td><?php echo $row['jenis_2'] ?></td>
                                <td><?php echo $row['kuantiti_2'] ?></td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                                <tr>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td><?php echo $row['jenama_3'] ?></td>
                                <td><?php echo $row['jenis_3'] ?></td>
                                <td><?php echo $row['kuantiti_3'] ?></td>
                                <td> - </td>
                                <td> - </td>
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
            $('#table_lazada').DataTable();
            });
</script>
        