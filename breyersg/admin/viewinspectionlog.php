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
        
    $qry = mysqli_query($con, "DELETE FROM penghantaran WHERE penghantaran_id ='" .mres($con, $_GET["delete_id"])."'");

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
        <?php include ("header.php"); ?>
         <div class="row" style="padding-left: 0px; padding-right: 0px;">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
             <?php include ("leftmenu.php"); ?>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
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
                    <div class="panel panel-warning">
                      <div class="panel-heading">Inspections Log</div>
                      <div class="panel-body">
                          <div class="well">
                            <div style="margin-bottom: 25px" class="input-group">
                                <input type="hidden" name="kenderaan_id" value="<?php echo $kenderaan_id; ?>">
                                <span class="input-group-addon">Plat No.</span>
                                <input type="text" class="form-control" name="plat_no" id="plat_no" value="<?php echo $plat_no; ?>" readonly>
                           </div>
                       </div>  
                        <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Inspection Event</th>
                            <th>Remark</th>
                            
                        </tr>
                            </thead>
                            <tbody>
                       <?php
                        $qry = "";
                        $qry = mysqli_query($con, "SELECT * FROM inspection WHERE no_plat='".$plat_no."' ORDER BY inspection_id desc");
                        while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                            ?>
                            <tr>
                                <td><?php echo $row["inspection_id"] ?></td>
                                <td>Driver Name</td>
                                <td><?php echo $row['driver_name'] ?></td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Plat No.</td>
                                <td><?php echo $row['no_plat'] ?></td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Date</td>
                                <td><?php echo $row['date'] ?></td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Windshield Wipers</td>
                                <td><?php echo $row['wipers'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Mirrors</td>
                                <td><?php echo $row['mirrors'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Instruments Operations</td>
                                <td><?php echo $row['instrument'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>E-Brake</td>
                                <td><?php echo $row['e_brake'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Brakes</td>
                                <td><?php echo $row['brake'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Horn</td>
                                <td><?php echo $row['horn'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Steering / Alignment</td>
                                <td><?php echo $row['steering'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Engine Oil Level</td>
                                <td><?php echo $row['engine_oil'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Air Cleaner</td>
                                <td><?php echo $row['air_cleaner'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Glass</td>
                                <td><?php echo $row['glass'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Air Conditioner</td>
                                <td><?php echo $row['aircond'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>General Engine Operation</td>
                                <td><?php echo $row['general_engine'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Cooling System</td>
                                <td><?php echo $row['cooling'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Leaks Oil, Fuel, Coolant</td>
                                <td><?php echo $row['leakage'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Tires / Tire Pressure</td>
                                <td><?php echo $row['tires'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Belts</td>
                                <td><?php echo $row['belts'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Starter / Ignition</td>
                                <td><?php echo $row['starter'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Alternator Output</td>
                                <td><?php echo $row['alt_output'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Fuel System</td>
                                <td><?php echo $row['fuel'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Suspension System</td>
                                <td><?php echo $row['suspension'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Transmission Oil Level</td>
                                <td><?php echo $row['transmission'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Brake Lights</td>
                                <td><?php echo $row['brake_lights'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Turn Signals</td>
                                <td><?php echo $row['signals'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Head Lights</td>
                                <td><?php echo $row['headlights'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Battery Operation / Levels</td>
                                <td><?php echo $row['battery'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Exhaust System</td>
                                <td><?php echo $row['exhaust'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Reflectors</td>
                                <td><?php echo $row['reflectors'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Scratches / Dents</td>
                                <td><?php echo $row['scratches'] ?>/5</td>
                            </tr>
                            <tr>
                                <td> - </td>
                                <td>Others</td>
                                <td><?php echo $row['others'] ?>/5</td>
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
<script type="text/javascript" charset="utf8" src="../DataTables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="../DataTables/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
                $("#btn_search").click(function(e){
                    if($("#search_text").val() == ''){
                        $("#search_text").css("border-color","#DA1908");
                        $("#search_text").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form-search').unbind('submit').submit();
                    }
                });
            });
    </script>
                
