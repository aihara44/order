<?php
    session_start();
    
    if(!isset($_SESSION["operasi"])){
        header("location:login.php");
    }
    include ("../connection.php");

?>
        <?php include ("header2.php"); ?>
         <div class="row" style="padding-left: 0px; padding-right: 0px;">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                <div class="col-md-8">
             <?php include ("leftmenu.php"); ?>
                </div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
              <div class="col-md-9">
              <div class="well">
                    <div class="panel panel-primary">
                      <div class="panel-heading">Customer Deliveries</div>
                      <div class="panel-body">
                        <table class="table table-hover table-bordered" id="table_customers">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Driver Name</th>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Plat No.</th>
                            <th>Platform</th>
                        </tr>
                            </thead>
                            <tbody>
                       <?php
                        $qry = "";

                        $qry = mysqli_query($con, "SELECT * FROM online ORDER BY online_id desc");
                        while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                            ?>
                            <tr>
                                <td><?php echo $row['tarikh'] ?></td>
                                <td><?php echo $row['nama_pelanggan'] ?></td>
                                <td><?php echo $row['alamat'] ?></td>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['jenama'] ?></td>
                                <td><?php echo $row['jenis'] ?></td>
                                <td><?php echo $row['kuantiti'] ?></td>
                                <td><?php echo $row['no_plat'] ?></td>
                                <td><?php echo $row['platform'] ?></td>
                            </tr>
                            <?php
                            }
                       ?>
                    </tbody>
                </table>
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
            $('#table_customers').DataTable();
            });
</script>
        