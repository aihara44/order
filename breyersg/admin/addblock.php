<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    
    include ("../connection.php");

    $msg = "";
    $block_id = "";
    $block = "";
    $year = "";
    $month = "";

    if(isset($_GET["edit_id"])){
        $qe = mysqli_query($con, "SELECT * FROM blok WHERE blok_id ='".mres($con, $_GET["edit_id"])."'");
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $block_id = $row["blok_id"];
            $block = $row["blok"];
            $year = $row["tahun"];
            $month = $row["bulan"];
        }
    }
    
    if(isset($_POST["btn_save"])){
    $block = mres($con, $_POST["block"]);
    $year = mres($con, $_POST["year"]);
    $month = mres($con, $_POST["month"]);
    
    $qry = mysqli_query($con, "INSERT INTO blok values('','".$block."','".$year."','".$month."')");

        if($qry){
            $msg = '<div id="login-alert" class="alert alert-success col-sm-12">Success! Data Is Inserted.</div>';
            }else{
            $msg = '<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Data cannot inserted.</div>';
            }
        
    }

    if(isset($_POST["btn_edit"])){
    $block = mres($con, $_POST["block"]);
    $year = mres($con, $_POST["year"]);
    $month = mres($con, $_POST["month"]);
    $block_id = mres($con, $_POST["block_id"]);
    
    $qry = mysqli_query($con, "UPDATE blok SET blok='".$block."', tahun='".$year."', bulan='".$month."' where blok_id='".$block_id."'");

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
                       <div class="panel-title">Add PPUKM Department Block</div>
                    </div>
                   <div class="panel-body">
                       <?php echo $msg; ?>
                   <form id="form_block" class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                       <div style="margin-bottom: 25px" class="input-group">
                           <input type="hidden" name="block_id" value="<?php echo $block_id; ?>">
                           <span class="input-group-addon">Department Block</span>
                           <input type="text" class="form-control" name="block" id="block" value="<?php echo $block; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Year</span>
                           <select type="text" class="form-control" name="year" id="year" value="<?php echo $year; ?>">
                                <option value="">-- Select Year --</option>
                               <?php 
                                $qry = mysqli_query($con, "SELECT * FROM tahun");
                               while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                                   echo '<option value="'.$row["tahun_id"].'">'.$row["tahun"].'</option>';
                               }
                               ?>
                           </select>
                       </div>
                        <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Month</span>
                           <select type="text" class="form-control" name="month" id="month" value="<?php echo $month; ?>">
                                <option value="">-- Select Month --</option>
                           </select>
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
    <script>
        $(document).ready(function(){
            $('#year').on('change',function(){
                    var tahun_id = $(this).val();
                    if(tahun_id){
                        $.ajax({
                            type:'POST',
                            url:'fetch.php',
                            data:'tahun_id='+tahun_id,
                            success:function(html){
                                $('#month').html(html);
                            }
                        }); 
                    }else{
                        $('#month').html('<option value="">-- Select Month --</option>');
                    }
                });
                
                $('#month').on('change',function(){
                    var bulan_id = $(this).val();
                    if(bulan_id){
                        $.ajax({
                            type:'POST',
                            url:'fetch.php',
                            data:'bulan_id='+bulan_id,
                            success:function(html){
                                $('#block').html(html);
                                $('#level').html('<option value="">-- Select Level --</option>'); 
                            }
                        }); 
                    }else{
                        $('#month').html('<option value="">-- Select Month --</option>');
                        $('#level').html('<option value="">-- Select Level --</option>');
                    }
                });
                        
                $('#block').on('change',function(){
                    var block_id = $(this).val();
                    if(block_id){
                        $.ajax({
                            type:'POST',
                            url:'fetch.php',
                            data:'block_id='+block_id,
                            success:function(html){
                                $('#level').html(html);        
                            }
                        }); 
                    }else{
                        $('#level').html('<option value="">-- Select Level --</option>');
                        $('#unit').html('<option value="">-- Select Unit --</option>'); 
                    }
                });
            
                $('#level').on('change',function(){
                    var level_id = $(this).val();
                    if(level_id){
                        $.ajax({
                            type:'POST',
                            url:'fetch.php',
                            data:'level_id='+level_id,
                            success:function(html){
                                $('#unit').html(html);        
                            }
                        }); 
                    }else{
                        $('#unit').html('<option value="">-- Select Unit --</option>'); 
                    }
                });
              $('input[class="form-control"]').focus(function() {
                  $(this).removeAttr('style');
              });
                $("#btn_save, #btn_edit").click(function(e){
                    if($("#block").val() == ''){
                        $("#block").css("border-color","#DA1908");
                        $("#block").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#year").val() == ''){
                        $("#year").css("border-color","#DA1908");
                        $("#year").css("background","#F2DEDE");
                        e.preventDefault();
                    }
                    if($("#month").val() == ''){
                        $("#month").css("border-color","#DA1908");
                        $("#month").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form_block').unbind('submit').submit();
                    }
                });
            });
    </script>

