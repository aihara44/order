<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    
    include ("../connection.php");

    $msg = "";
    $kenderaan_id = "";
    $transport = "";
    $transport_id = "";
    $plat_no = "";
    $tyre = "";
    $date = "";
    

    if(isset($_GET["edit_id"])){
        $qe = mysqli_query($con, "SELECT * FROM kenderaan WHERE kenderaan_id='".mres($con, $_GET["edit_id"])."'");
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $kenderaan_id = $row["kenderaan_id"];
            $transport = $row["kenderaan"];
            $transport_id = $row["nombor_id_kenderaan"];
            $plat_no = $row["no_plat"];
            $tyre = $row["saiz_tayar"];
        }
    }
    
    if(isset($_POST["btn_save"])){
    $transport = mres($con, $_POST["transport"]);
    $transport_id = mres($con, $_POST["transport_id"]);
    $plat_no = mres($con, $_POST["plat_no"]);
    $tyre = mres($con, $_POST["tyre"]);
    $date = mres($con, $_POST["date"]);
    $qry = mysqli_query($con, "INSERT INTO kenderaan values('','".$transport."','".$transport_id."','".$plat_no."','".$tyre."','".$date."')");

    if($qry){
        $msg = '<div id="login-alert" class="alert alert-success col-sm-12">Success! Data Is Inserted.</div>';
        }else{
        $msg = '<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Data cannot inserted.</div>';
        }
    }

    if(isset($_POST["btn_edit"])){
    $transport = mres($con, $_POST["transport"]);
    $transport_id = mres($con, $_POST["transport_id"]);
    $plat_no = mres($con, $_POST["plat_no"]);
    $tyre = mres($con, $_POST["tyre"]);
    $date = mres($con, $_POST["date"]);
    $kenderaan_id = mres($con, $_POST["kenderaan_id"]);
    $qry = mysqli_query($con, "UPDATE kenderaan SET kenderaan='".$transport."', nombor_id_kenderaan='".$transport_id."', no_plat='".$plat_no."', saiz_tayar='".$tyre."', tahun='".$date."' where kenderaan_id='".$kenderaan_id."'");

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
                       <div class="panel-title">Add Transport</div>
                    </div>
                   <div class="panel-body">
                       <?php echo $msg; ?>
                   <form id="form_transport" class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                       <div style="margin-bottom: 25px" class="input-group">
                           <input type="hidden" name="kenderaan_id" value="<?php echo $kenderaan_id; ?>">
                           <span class="input-group-addon">Transport</span>
                           <input type="text" class="form-control" name="transport" id="transport" value="<?php echo $transport; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Transport Identification Number</span>
                           <input type="text" class="form-control" name="transport_id" id="transport_id" value="<?php echo $transport_id; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Plat No.</span>
                           <input type="text" class="form-control" name="plat_no" id="plat_no" value="<?php echo $plat_no; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Tyre Size</span>
                           <input type="text" class="form-control" name="tyre" id="tyre" value="<?php echo $tyre; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Date</span>
                           <input type="date" class="form-control" name="date" id="date" value="<?php echo $date; ?>" />
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
                    if($("#transport").val() == ''){
                        $("#transport").css("border-color","#DA1908");
                        $("#transport").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#transport_id").val() == ''){
                        $("#transport_id").css("border-color","#DA1908");
                        $("#transport_id").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#tyre").val() == ''){
                        $("#tyre").css("border-color","#DA1908");
                        $("#tyre").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#plat_no").val() == ''){
                        $("#plat_no").css("border-color","#DA1908");
                        $("#plat_no").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#date").val() == ''){
                        $("#date").css("border-color","#DA1908");
                        $("#date").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form_transport').unbind('submit').submit();
                    }
                });
            });
    </script>

