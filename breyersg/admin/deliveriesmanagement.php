<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    include ("../connection.php");

    $kenderaan_id = "";
    $plat_no = "";
    $transport_id = "";
    $tyre = "";
    $date = "";
    $msg = "";
    
    if(isset($_GET["get_id"])){
        $qe = mysqli_query($con, "SELECT kenderaan_id, no_plat, nombor_id_kenderaan, saiz_tayar, tahun FROM kenderaan WHERE kenderaan_id='".mres($con, $_GET["get_id"])."'");
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $kenderaan_id = $row["kenderaan_id"];
            $plat_no = $row["no_plat"];
            $transport_id = $row["nombor_id_kenderaan"];
            $tyre = $row["saiz_tayar"];
            $date = $row["tahun"];

        }
    }

    if (isset($_GET["delete_id"])){
        
    $qry = mysqli_query($con, "DELETE FROM penghantaran WHERE penghantaran_id ='" .mres($con, $_GET["delete_id"])."'");

    if($qry){
        $msg='<div id="login-alert" class="alert alert-success col-sm-12">Success! Data was Deleted</div>';
    }else{
        $msg='<div id="login-alert" class="alert alert-danger col-sm-12">Failure! Cannot Delete from Database</div>';
        }
    }
?>
        <?php include ("header.php"); ?>
         <div class="row" style="padding-left: 0px; padding-right: 0px;">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
             <?php include ("leftmenu.php"); ?>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
              <div class="well">
                  <form method="post" class="form-inline" id="form-search" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <div class="form-group">
                          <label>Search By Username:</label>
                           <input type="text" class="form-control" name="search_text" id="search_text">
                           <button type="submit" class="btn btn-default" id="btn_search" name="btn_search">Search</button>
                        </div>
                  </form>
              </div>
              <div class="well">
                    <div class="panel panel-primary">
                      <div class="panel-heading">Delivery Log</div>
                      <div class="panel-body">
                          <?php echo $msg; ?>
                          <div class="well">
                           <h3 style="text-align: center">Vehicle Identification Information</h3>
                            <div style="margin-bottom: 25px" class="input-group">
                                <input type="hidden" name="kenderaan_id" value="<?php echo $kenderaan_id; ?>">
                                <span class="input-group-addon">Plat No.</span>
                                <input type="text" class="form-control" name="plat_no" id="plat_no" value="<?php echo $plat_no; ?>" readonly>
                           </div>
                           <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon">Vehicle Identification Number</span>
                                <input type="text" class="form-control" name="transport_id" id="transport_id" value="<?php echo $transport_id; ?>" readonly>
                           </div>
                           <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon">Tire Size</span>
                                <input type="text" class="form-control" name="tyre" id="tyre" value="<?php echo $tyre; ?>" readonly>
                           </div>
                           <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon">Vehicle Year</span>
                                <input type="date" class="form-control" name="date" id="date" value="<?php echo $date; ?>" readonly>
                           </div>
                       </div> 
                        <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Plat No.</th>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Fuel Serial No.</th>
                            <th>Petrol Type</th>
                            <th>Price (RM)</th>
                            <th>Action</th>
                        </tr>
                            </thead>
                            <tbody>
                       <?php
                        $qry = "";
                        $qry1 = "";
                        
                        if(isset($_POST["search_text"])) {
                            $qry = mysqli_query($con, "SELECT * FROM penghantaran WHERE username LIKE '%".mres($con,$_POST["search_text"])."%' ORDER BY penghantaran_id desc");
                        }else{
                            $qry = mysqli_query($con, "SELECT * FROM penghantaran WHERE no_plat='".$plat_no."' ORDER BY penghantaran_id desc");
                        }       
                        while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                            ?>
                            <tr>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['no_plat'] ?></td>                            
                                <td><?php echo $row['jenama_1'] ?></td>                            
                                <td><?php echo $row['jenis_1'] ?></td>
                                <td><?php echo $row['kuantiti_1'] ?></td>
                                <td><?php echo $row['lokasi_1'] ?></td>
                                <td><?php echo $row['tarikh'] ?></td>
                                <td><?php echo $row['no_siri'] ?></td>
                                <td><?php echo $row['petrol'] ?></td>
                                <td>RM<?php echo $row['harga'] ?></td>
                                <?php
                                    echo "<td><a href='?delete_id='".$row["penghantaran_id"]."' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a></td>";
                                ?>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td> - </td>                            
                                <td><?php echo $row['jenama_2'] ?></td>                            
                                <td><?php echo $row['jenis_2'] ?></td>
                                <td><?php echo $row['kuantiti_2'] ?></td>
                                <td><?php echo $row['lokasi_2'] ?></td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td> - </td>
                                <td><?php echo $row['jenama_3'] ?></td>                            
                                <td><?php echo $row['jenis_3'] ?></td>
                                <td><?php echo $row['kuantiti_3'] ?></td>
                                <td><?php echo $row['lokasi_3'] ?></td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td> - </td>
                                <td><?php echo $row['jenama_4'] ?></td>                            
                                <td><?php echo $row['jenis_4'] ?></td>
                                <td><?php echo $row['kuantiti_4'] ?></td>
                                <td><?php echo $row['lokasi_4'] ?></td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td> - </td>
                                <td><?php echo $row['jenama_5'] ?></td>                            
                                <td><?php echo $row['jenis_5'] ?></td>
                                <td><?php echo $row['kuantiti_5'] ?></td>
                                <td><?php echo $row['lokasi_5'] ?></td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
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
        