<?php
    session_start();
    
    if(!isset($_SESSION["admin_name"])){
        header("location:login.php");
    }
    include ("../connection.php");
    $msg = "";

    if (isset($_GET["delete_id"])){
        
    $qry = mysqli_query($con, "DELETE FROM blok WHERE blok_id ='" .mres($con, $_GET["delete_id"])."'");

    if($qry){
        $msg='<div id="login-alert" class="alert alert-success col-sm-12">Success! Data was Deleted</div>';
    }else{
        $msg='<div id="login-alert" class="alert alert-danger col-sm-12">Failure! Cannot Delete from Database</div>';
        }
    }
  
?>
        <?php include ("header2.php"); ?>
         <div class="row" style="padding-left: 0px; padding-right: 0px;">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="padding-left: 0px; padding-right: 0px;">
             <?php include ("leftmenu.php"); ?>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
               <div class="panel panel-info">
                   <div class="panel-heading">
                      PPUKM Department Block Management
                   </div>
                   <div class="panel-body">
                       <?php echo $msg; ?>
                <table class="table table-hover table-bordered" id="table_block">
                    <thead>
                        <tr>
                            <th>Department Block</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        $qry = "";
                    
                            $qry = mysqli_query($con, "SELECT * FROM blok ORDER BY blok_id asc");
                        
                        while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
                            echo '<tr>';
                            echo '<td>'.$row["blok"]."</td><td><a href='addblock.php?edit_id=".$row["blok_id"]."' class='btn btn-primary'>Edit</a> | <a href='?delete_id=".$row["blok_id"]."' onclick=\"return confirm('Are you sure you want to delete this item?');\" class='btn btn-danger'>Delete</a></td>";
                            echo '</tr>';
                        }
                        ?>
                        
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
<script type="text/javascript" charset="utf8" src="../DataTables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="../DataTables/js/jquery.dataTables.min.js"></script>
    <script>

        $(document).ready(function(){
             $('#table_block').DataTable();
            });
    </script>
        