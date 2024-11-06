<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    
    include ("../connection.php");

    $msg = "";
    $kad_id = "";
    $serial_no = "";
    

    if(isset($_GET["edit_id"])){
        $qe = mysqli_query($con, "SELECT * FROM kad_petrol WHERE kad_id='".mres($con, $_GET["edit_id"])."'");
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $kad_id = $row["kad_id"];
            $serial_no = $row["no_siri"];
        }
    }
    
    if(isset($_POST["btn_save"])){
    $serial_no = mres($con, $_POST["serial_no"]);
    $qry = mysqli_query($con, "INSERT INTO kad_petrol values('','".$serial_no."')");

    if($qry){
        $msg = '<div id="login-alert" class="alert alert-success col-sm-12">Success! Data Is Inserted.</div>';
        }else{
        $msg = '<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Data cannot inserted.</div>';
        }
    }

    if(isset($_POST["btn_edit"])){
    $serial_no = mres($con, $_POST["serial_no"]);
    $kad_id = mres($con, $_POST["kad_id"]);
    $qry = mysqli_query($con, "UPDATE kad_petrol SET no_siri='".$serial_no."' where kad_id='".$kad_id."'");

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
                       <div class="panel-title">Add Petrol Card</div>
                    </div>
                   <div class="panel-body">
                       <?php echo $msg; ?>
                   <form id="form_petrolcard" class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                       <div style="margin-bottom: 25px" class="input-group">
                           <input type="hidden" name="kad_id" value="<?php echo $kad_id; ?>">
                           <span class="input-group-addon">Serial Number</span>
                           <input type="text" class="form-control" name="serial_no" id="serial_no" value="<?php echo $serial_no; ?>" />
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
                    if($("#serial_no").val() == ''){
                        $("#serial_no").css("border-color","#DA1908");
                        $("#serial_no").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form_petrolcard').unbind('submit').submit();
                    }
                });
            });
    </script>

