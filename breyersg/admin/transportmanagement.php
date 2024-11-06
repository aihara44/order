<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    include ("../connection.php");
    $msg = "";

    if (isset($_GET["delete_id"])){
        
    $qry = mysqli_query($con, "DELETE FROM kenderaan WHERE kenderaan_id ='" .mres($con, $_GET["delete_id"])."'");

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
                          <label>Search By Transport:</label>
                           <input type="text" class="form-control" name="search_text" id="search_text">
                           <button type="submit" class="btn btn-default" id="btn_search" name="btn_search">Search</button>
                        </div>
                  </form>
              </div>
               <div class="panel panel-info">
                   <div class="panel-heading">
                      Transport Management
                   </div>
                   <div class="panel-body">
                       <?php echo $msg; ?>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Transport</th>
                            <th>Transport ID</th>
                            <th>Plat No.</th>
                            <th>Tyre Size</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        $qry = "";
                        
                        if(isset($_POST["btn_search"])) {
                            $qry = mysqli_query($con, "SELECT * FROM kenderaan WHERE kenderaan LIKE '%".mres($con,$_POST["search_text"])."%' ORDER BY kenderaan_id asc");
                        }else{
                            $qry = mysqli_query($con, "SELECT * FROM kenderaan ORDER BY kenderaan_id asc");
                        }
                        while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                            echo '<tr>';
                            echo '<td>'.$row["kenderaan"]."</td><td>".$row["nombor_id_kenderaan"]."</td><td>".$row["no_plat"]."</td><td>".$row["saiz_tayar"]."</td><td>".$row["tahun"]."</td><td><a href='addtransport.php?edit_id=".$row["kenderaan_id"]."'  class='btn btn-primary'>Edit</a> | <a href='?delete_id=".$row["kenderaan_id"]."' onclick=\"return confirm('Are you sure you want to delete this item?');\" class='btn btn-danger'>Delete</a></td>";
                            echo '</tr>';
                        }
                        ?>
                        
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
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
        