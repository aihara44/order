<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    
    include ("../connection.php");

    $msg = "";
    $department_id = "";
    $customer_id = "";
    $department = "";
    $unit = "";
    $block = "";
    $level = "";
    $dpquota = "";

    if(isset($_GET["edit_id"])){
        $qe = mysqli_query($con, "SELECT * FROM jabatan WHERE jabatan_id ='".mres($con, $_GET["edit_id"])."'");
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $department_id = $row["jabatan_id"];
            $customer_id = $row["customer_id"];
            $department = $row["jabatan"];
            $dpquota = $row["peruntukan_bulanan"];
        }
    }
    
    if(isset($_POST["btn_save"])){
        $customer_id = mres($con, $_POST["customer_id"]);
        $department = mres($con, $_POST["department"]);
        $unit = mres($con, $_POST["unit"]);
        $block = mres($con, $_POST["block"]);
        $level = mres($con, $_POST["level"]);
        $dpquota = mres($con, $_POST["dpquota"]);

        $qry = mysqli_query($con, "INSERT INTO jabatan values('','".$customer_id."','".$department."','".$block."','".$level."','".$unit."','".$dpquota."')");

            if($qry){
                $msg = '<div id="login-alert" class="alert alert-success col-sm-12">Success! Data Is Inserted.</div>';
                }else{
                $msg = '<div id="login-alert" class="alert alert-danger col-sm-12">Fail! Data cannot inserted.</div>';
                }
        
    }

    if(isset($_POST["btn_edit"])){
        $customer_id = mres($con, $_POST["customer_id"]);
        $department = mres($con, $_POST["department"]);
        $unit = mres($con, $_POST["unit"]);
        $block = mres($con, $_POST["block"]);
        $level = mres($con, $_POST["level"]);
        $dpquota = mres($con, $_POST["dpquota"]);
        $department_id = mres($con, $_POST["department_id"]);

        $qry = mysqli_query($con, "UPDATE jabatan SET customer_id='".$customer_id."', jabatan='".$department."', unit='".$unit."', blok='".$block."', tingkat='".$level."', peruntukan_bulanan='".$dpquota."' where jabatan_id='".$department_id."'");

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
                       <div class="panel-title">Add PPUKM Department Unit</div>
                    </div>
                   <div class="panel-body">
                       <?php echo $msg; ?>
                   <form id="form_unit" class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                       <div style="margin-bottom: 25px" class="input-group">
                           <input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
                           <span class="input-group-addon">Customer ID</span>
                           <input type="text" class="form-control" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Department Name</span>
                           <input type="text" class="form-control" name="department" id="department" value="<?php echo $department; ?>" />
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Year</span>
                           <select type="text" class="form-control" name="year" id="year">
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
                           <select type="text" class="form-control" name="month" id="month">
                                <option value="">-- Select Month --</option>
                           </select>
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Block</span>
                           <select type="text" class="form-control" name="block" id="block">
                                <option value="">-- Select Block --</option>
                           </select>
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Level</span>
                           <select type="text" class="form-control" name="level" id="level">
                                <option value="">-- Select Level --</option>
                           </select>
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Unit</span>
                           <select type="text" class="form-control" name="unit" id="unit">
                                <option value="">-- Select Unit --</option>
                           </select>
                       </div>
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon">Department Monthly Quota</span>
                           <input type="text" class="form-control" name="dpquota" id="dpquota" value="<?php echo $dpquota; ?>" />
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
                            }
                        }); 
                    }else{
                        $('#block').html('<option value="">-- Select Block --</option>');
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
                    if($("#level").val() == ''){
                        $("#level").css("border-color","#DA1908");
                        $("#level").css("background","#F2DEDE");
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
                    }
                    if($("#block").val() == ''){
                        $("#block").css("border-color","#DA1908");
                        $("#block").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form_level').unbind('submit').submit();
                    }
                });
            });
    </script>

