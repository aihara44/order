<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    
    include ("../connection.php");

    $msg = "";
    $lokasi_id = "";
    $location = "";
    $date = "";
    

    if(isset($_GET["edit_id"])){
        $qe = mysqli_query($con, "SELECT * FROM lokasi WHERE lokasi_id='".mres($con, $_GET["edit_id"])."'");
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $lokasi_id = $row["lokasi_id"];
            $location = $row["lokasi"];
        }
    }
    
    if(isset($_POST["btn_save"])){
    $location = mres($con, $_POST["location"]);
    $date = mres($con, $_POST["date"]);
    $qry = mysqli_query($con, "INSERT INTO lokasi values('','".$location."','".$date."')");

    if($qry){
        $msg = '<div id="login-alert" class="alert alert-success col-sm-12">Success! Data Is Inserted.</div>';
        }else{
        $msg = '<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Data cannot inserted.</div>';
        }
    }

    if(isset($_POST["btn_edit"])){
    $location = mres($con, $_POST["location"]);
    $date = mres($con, $_POST["date"]);
    $lokasi_id = mres($con, $_POST["lokasi_id"]);
    $qry = mysqli_query($con, "UPDATE lokasi SET lokasi='".$location."', tarikh='".$date."' where lokasi_id='".$lokasi_id."'");

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
                       <div class="panel-title">Add Location</div>
                    </div>
                   <div class="panel-body">
                       <?php echo $msg; ?>
                   <form id="form_location" class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                       <div style="margin-bottom: 25px" class="input-group">
                           <input type="hidden" name="lokasi_id" value="<?php echo $lokasi_id; ?>">
                           <span class="input-group-addon">Location</span>
                           <input type="text" class="form-control" name="location" id="location" value="<?php echo $location; ?>" />
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
                    if($("#location").val() == ''){
                        $("#location").css("border-color","#DA1908");
                        $("#location").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#date").val() == ''){
                        $("#date").css("border-color","#DA1908");
                        $("#date").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form_location').unbind('submit').submit();
                    }
                });
            });
    </script>

