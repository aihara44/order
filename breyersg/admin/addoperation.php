<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    
    include ("../connection.php");

    $msg = "";
    $operasi_id = "";
    $driver_name = "";
    $transport = "";
    $plat_no = "";
    $date = "";
    $username = "";
    $password = "";

    if(isset($_GET["edit_id"])){
        $qe = mysqli_query($con, "SELECT * FROM operasi WHERE operasi_id='".mres($con, $_GET["edit_id"])."'");
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $operasi_id = $row["operasi_id"];
            $driver_name = $row["nama_pemandu"];
            $transport = $row["kenderaan"];
            $plat_no = $row["no_plat"];
            $date = $row["tarikh"];
            $username = $row["username"];
        }
    }
    
    if(isset($_POST["btn_save"])){
    $driver_name = mres($con, $_POST["driver_name"]);
    $transport = mres($con, $_POST["transport"]);
    $plat_no = mres($con, $_POST["plat_no"]);
    $date = mres($con, $_POST["date"]);
    $username = mres($con, $_POST["username"]);
    $password = md5(mres($con, $_POST["password"]));
    $qry = mysqli_query($con, "INSERT INTO operasi values('','".$driver_name."','".$transport."','".$date."','".$plat_no."','".$username."','".$password."')");

    if($qry){
        $msg = '<div id="login-alert" class="alert alert-success col-sm-12">Success! Data Is Inserted.</div>';
        }else{
        $msg = '<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Data cannot inserted.</div>';
        }
    }

    if(isset($_POST["btn_edit"])){
    $driver_name = mres($con, $_POST["driver_name"]);
    $transport = mres($con, $_POST["transport"]);
    $plat_no = mres($con, $_POST["plat_no"]);
    $date = mres($con, $_POST["date"]);
    $username = mres($con, $_POST["username"]);
    $password = md5(mres($con, $_POST["password"]));
    $operasi_id = mres($con, $_POST["operasi_id"]);
    $qry = mysqli_query($con, "UPDATE subject SET nama_pemandu='".$driver_name."', kenderaan='".$course."', tarikh='".$date."', no_plat='".$plat_no."', username='".$username."', password='".$password."' where operasi_id='".$operasi_id."'");

    if($qry){
        $msg = '<div id="login-alert" class="alert alert-success col-sm-12">Success! Data Is Updated.</div>';
        }else{
        $msg = '<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Data cannot Updated.</div>';
        }
    }
?>
   

   <?php include ("header.php"); ?>
    <div class="row" style="padding-left: 0px; padding-right: 0px;">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
             <?php include ("leftmenu.php"); ?>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div class="panel panel-info">
                   <div class="panel-heading">
                       <div class="panel-title">Add Operation</div>
                    </div>
                   <div class="panel-body">
                       <?php echo $msg; ?>
                   <form id="form_operation" class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                       <div style="margin-bottom: 25px" class="input-group">
                           <input type="hidden" name="operasi_id" value="<?php echo $operasi_id; ?>">
                           <span class="input-group-addon">Driver Name</span>
                           <select class="form-control" name="driver_name" id="driver_name" value="<?php echo $driver_name; ?>">
                               <option>-- Driver Name --</option>
                           <?php 
                               $query = mysqli_query($con, "SELECT nama_pemandu FROM operasi") or die (mysqli_error($con));
                               while($row = mysqli_fetch_array($query)) {
                                   echo'<option value="'.$row['nama_pemandu'].'">'.$row['nama_pemandu'].'</option>';
                               }
                               
                               ?>
                           </select>
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Transport</span>
                           <select class="form-control" name="transport" id="transport" value="<?php echo $transport; ?>">
                               <option>-- Transport --</option>
                           <?php 
                               $query = mysqli_query($con, "SELECT kenderaan_id, kenderaan FROM kenderaan") or die (mysqli_error($con));
                               while($row = mysqli_fetch_array($query)) {
                                   echo'<option value="'.$row['kenderaan_id'].'">'.$row['kenderaan'].'</option>';
                               }
                               
                               ?>
                           </select>
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Plat No.</span>
                           <select class="form-control" name="plat_no" id="plat_no" value="<?php echo $plat_no; ?>">
                               <option>-- Plat No. --</option>
                           <?php 
                               $query = mysqli_query($con, "SELECT kenderaan_id, no_plat FROM kenderaan") or die (mysqli_error($con));
                               while($row = mysqli_fetch_array($query)) {
                                   echo'<option value="'.$row['kenderaan_id'].'">'.$row['no_plat'].'</option>';
                               }
                               
                               ?>
                           </select>
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Date</span>
                           <input type="date" class="form-control" name="date" id="date" value="<?php echo $date; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Username</span>
                           <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Password</span>
                           <input type="password" class="form-control" name="password" id="password" />
                       </div>
                       <div style="margin-top: 10px" class="form-group">
                           <div class="col-sm-12 controls">
                               <?php if(!isset($_GET["edit_id"])){
                                    echo '<input type="submit" id="btn_save" name="btn_save" class="btn btn-info" value="Register"/>';
                                }else{
                                    echo '<input type="submit" id="btn_edit" name="btn_edit" class="btn btn-info" value="Edit"/>';
                                }
                            ?>
                            </div>
                       </div>
                    </form>
               </div>
            </div>
          </div>
    </div>
</div>
    <script>
        $(document).ready(function(){
              $('input[class="form-control"]').focus(function() {
                  $(this).removeAttr('style');
              });
                $("#btn_save, #btn_edit").click(function(e){
                    if($("#driver_name").val() == ''){
                        $("#driver_name").css("border-color","#DA1908");
                        $("#driver_name").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#transport").val() == ''){
                        $("#transport").css("border-color","#DA1908");
                        $("#transport").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#plat_no").val() == ''){
                        $("#plat_no").css("border-color","#DA1908");
                        $("#plat_no").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#transport").val() == ''){
                        $("#transport").css("border-color","#DA1908");
                        $("#transport").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#date").val() == ''){
                        $("#date").css("border-color","#DA1908");
                        $("#date").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#username").val() == ''){
                        $("#username").css("border-color","#DA1908");
                        $("#username").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#password").val() == ''){
                        $("#password").css("border-color","#DA1908");
                        $("#password").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form_subject').unbind('submit').submit();
                    }
                });
            });
    </script>

