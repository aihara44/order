<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    include ("../connection.php");

    $msg = "";
    $kenderaan_id = "";
    $plat_no = "";

    if(isset($_GET["get_id"])){

        $qe = mysqli_query($con, "SELECT jabatan.*, blok.blok as blokName, tingkat.tingkat as tingkatName, unit.unit as unitName FROM jabatan INNER JOIN tingkat ON jabatan.tingkat = tingkat.tingkat_id INNER JOIN blok ON jabatan.blok = blok.blok_id INNER JOIN unit ON jabatan.unit = unit.unit_id  WHERE jabatan.jabatan_id='".mres($con, $_GET["get_id"])."'");
        
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $jabatan_id = $row["jabatan_id"];
            $customer_id = $row["customer_id"];
            $department = $row["jabatan"];
            $unit = $row["unitName"];
            $block = $row["blokName"];
            $level = $row["tingkatName"];
            $dpquota = $row["peruntukan_bulanan"];
        }
    }
    if (isset($_GET["delete_id"])){
        
    $qry = mysqli_query($con, "DELETE FROM gallon WHERE gallon_id ='" .mres($con, $_GET["delete_id"])."'");

    if($qry){
        $msg='<div id="login-alert" class="alert alert-success col-sm-12">Success! Data was Deleted</div>';
    }else{
        $msg='<div id="login-alert" class="alert alert-danger col-sm-12">Failure! Cannot Delete from Database</div>';
        }
    }

    
  
?>
        <?php include ("header2.php"); ?>
<body>
         <div class="row" style="padding-left: 0px; padding-right: 0px;">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
                <div class="col-md-12">
             <?php include ("leftmenu.php"); ?>
                </div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
              <div class="col-md-12">
              <div class="well">
                    <div class="panel panel-success">
                      <div class="panel-heading">PPUKM Delivery Information</div>
                        <div class="panel-body">
                          <form method="post" class="form-inline" id="form-search" action="<?php echo $_SERVER["PHP_SELF"].(isset(($_GET["get_id"]))?'?get_id='.$_GET["get_id"]:'') ?>">
                           
                                 <div class="well">
                                   <h3 style="text-align: center">PPUKM Department Information</h3>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <input type="hidden" name="jabatan_id" value="<?php echo $jabatan_id; ?>">
                                        <span class="input-group-addon">Customer ID</span>
                                        <input type="text" class="form-control" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>" readonly>
                                   </div>
                                   <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon">Department Name</span>
                                        <input type="text" class="form-control" name="department" id="department" value="<?php echo $department; ?>" readonly>
                                   </div>
                                   <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon">Department Unit</span>
                                        <input type="text" class="form-control" name="unit" id="unit" value="<?php echo $unit; ?>" readonly>
                                   </div>
                                   <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon">Department Block</span>
                                        <input type="text" class="form-control" name="block" id="block" value="<?php echo $block; ?>" readonly>
                                   </div>
                                   <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon">Department Floor Level</span>
                                        <input type="text" class="form-control" name="level" id="level" value="<?php echo $level; ?>" readonly>
                                   </div>
                                   <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon">Department Monthly Quota</span>
                                        <input type="text" class="form-control" name="dpquota" id="dpquota" value="<?php echo $dpquota; ?>" readonly>
                                   </div>
                                </div>
                            
                                <div class="row" style="padding-left: 10px; ">
                                    <div class="form-group">
                                        <label>Search By Year:</label>
                                        <select class="form-control" name="year" id="year" style="width:170px;">
                                                <option value="">-- Select Year --</option>
                                            <?php 
                                                $qry = mysqli_query($con, "SELECT * FROM tahun");
                                                while($row=mysqli_fetch_array($qry, MYSQLI_ASSOC)){
                                                    echo "<option value='".$row["tahun"]."'>".$row["tahun"]."</option>";
                                                }
                                                ?>
                                        </select>
                                        <label>Search By Month:</label>
                                        <select class="form-control" name="month" id="month" style="width:170px;">
                                                <option value="">-- Select Month --</option>
                                             <?php 
                                                $qry = mysqli_query($con, "SELECT * FROM bulan");
                                                while($row=mysqli_fetch_array($qry, MYSQLI_ASSOC)){
                                                    echo "<option value='".$row["bulan"]."'>".$row["bulan"]."</option>";
                                                }
                                                ?>
                                        </select>
                                        <button type="submit" class="btn btn-default" id="btn_search" name="btn_search" >Search</button>
                                    </div>
                                </div>
                            </form>
                            <div style="clear:both"></div>                 
                            <br />  
                          <table class="table table-hover table-bordered" id="table_department">
                              <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Delivered Full Bottle</th>
                                    <th>Collected Empty Bottle</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Receipt Image</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                                <tbody>
                               <?php

                                $qry = "";

                                if(isset($_POST["btn_search"])) {
                                    $qry = mysqli_query($con, "SELECT * FROM gallon WHERE tahun LIKE '%".mres($con,$_POST["year"])."%' AND bulan LIKE '%".mres($con,$_POST["month"])."%' AND customer_id = '".$customer_id."'");
                                }else{
                                    $qry = mysqli_query($con, "SELECT * FROM gallon WHERE customer_id = '".$customer_id."' ORDER BY customer_id asc");
                                      }
                                while($row=mysqli_fetch_array($qry, MYSQLI_ASSOC)){
                                    echo '<tr>';
                                    echo '<td>'.$row["customer_id"]."</td><td>".$row["botol_penuh"]."</td><td>".$row["botol_kosong"]."</td><td>".$row["bulan"]."</td><td>".$row["tahun"]."</td><td><img src='../assests/images/stock/".$row["resit"]."'></td><td><a href='resit.php?get_id=".$row["gallon_id"]."' class='btn btn-primary'> View Receipt</a></td>";
                                    echo '</tr>';
                                    }

                                ?>

                    </tbody>
                       </table>
        </div>
              </div>
              </div>
        </div>
    </div>
            <script type="text/javascript" charset="utf8" src="../DataTables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="../DataTables/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){  
            $('#table_department').DataTable();
                
            });
</script>
        