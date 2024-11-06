<?php
    session_start();

    if(!isset($_SESSION["admin_name"])){
        header("location: login.php");
    }
    
    include ("../connection.php");

    $msg = "";

    if(isset($_GET["get_id"])){
        $qe = mysqli_query($con, "SELECT * FROM gallon WHERE gallon_id='".mres($con, $_GET["get_id"])."'");
        while($row=mysqli_fetch_array($qe,MYSQLI_ASSOC)){
            $gallon_id = $row["gallon_id"];
            $resit = $row["resit"];
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
        <?php include ("header.php"); ?>
<body>
         <div class="row" style="padding-left: 0px; padding-right: 0px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12">
                    <div class="well">
                    <div class="panel panel-success">
                      <div class="panel-heading">PPUKM Delivery Information</div>
                        <div class="panel-body">
                            <div class="thumbnail" style="width: 20%; display: block; margin-left: auto; margin-right: auto;">
                                <input type="hidden" name="gallon_id" id="gallon_id" value="<?php echo $gallon_id; ?>">
                                <img src="../assests/images/stock/<?php echo $resit; ?>" style="width:100%; height:100%;">
                            </div>
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
            $('#table_ppukm').DataTable();
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
        