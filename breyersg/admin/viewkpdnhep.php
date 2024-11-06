<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    include ("../connection.php");

    $msg = "";
    $kenderaan_id = "";
    $plat_no = "";

    if (isset($_GET["delete_id"])){
        
    $qry = mysqli_query($con, "DELETE FROM gallon WHERE gallon_id ='" .mres($con, $_GET["delete_id"])."'");

    if($qry){
        $msg='<div id="login-alert" class="alert alert-success col-sm-12">Success! Data was Deleted</div>';
    }else{
        $msg='<div id="login-alert" class="alert alert-danger col-sm-12">Failure! Cannot Delete from Database</div>';
        }
    }

    if(isset($_GET["get_id"])){
        $qe = mysqli_query($con, "SELECT kenderaan_id, no_plat FROM kenderaan WHERE kenderaan_id='".mres($con, $_GET["get_id"])."'");
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $kenderaan_id = $row["kenderaan_id"];
            $plat_no = $row["no_plat"];
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
                      <div class="panel-heading">KPDNHEP Delivery Information</div>
                        <div class="panel-body">
                          <div class="well">
                            <div style="margin-bottom: 25px" class="input-group">
                                <input type="hidden" name="kenderaan_id" value="<?php echo $kenderaan_id; ?>">
                                <span class="input-group-addon">Plat No.</span>
                                <input type="text" class="form-control" name="plat_no" id="plat_no" value="<?php echo $plat_no; ?>" readonly>
                           </div>
                       </div> 
                            <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="table_kpdnhep">
                    <thead>
                        <tr>
                            <th>Driver Name</th>
                            <th>Plat No.</th>
                            <th>Date</th>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Location</th>
                            <th>Serial No.</th>
                            <th>Fuel Type</th>
                            <th>Price</th>
                        </tr>
                            </thead>
                        <tbody>
                       <?php
                        $qry = "";
                            $qry = mysqli_query($con, "SELECT * FROM gallon WHERE no_plat='".$plat_no."' and lokasi = 'KPDNHEP (Kementerian Perdagangan Dalam Negeri Dan Hal Ehwal Pengguna)' ORDER BY gallon_id desc");
                        while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                            ?>
                            <tr>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['no_plat'] ?></td>
                                <td><?php echo $row['tarikh'] ?></td>
                                <td><?php echo $row['jenama'] ?></td>
                                <td><?php echo $row['jenis'] ?></td>
                                <td><?php echo $row['kuantiti'] ?></td>
                                <td><?php echo $row['lokasi'] ?></td>
                                <td><?php echo $row['no_siri'] ?></td>
                                <td><?php echo $row['petrol'] ?></td>
                                <td>RM <?php echo $row['jumlah'] ?></td>
                                <?php
                                
                                    echo "<td><a href='?delete_id=".$row["gallon_id"]."' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a></td>";
                                
                                ?>
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
</body>
<script type="text/javascript" charset="utf8" src="../DataTables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="../DataTables/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#table_kpdnhep').DataTable();
            });
                $("#btn_search").click(function(e){
                    
                    if($("#search_text").val() == ''){
                        $("#search_text").css("border-color","#DA1908");
                        $("#search_text").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form-search').unbind('submit').submit();
                    }
                });
            
    </script>
        