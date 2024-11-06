<?php
    session_start();
    include ("../connection.php");

    $form_username = "";
    $form_password = "";
    $msg_username = "";
    $msg_password = "";
    $username = "";

if(isset($_POST["btn_username"])) {
    $qry = mysqli_query($con, "SELECT admin_name FROM admin WHERE admin_name='".mres($con,$_POST["username"])."'") or die (mysqli_error($con));
    if(mysqli_num_rows($qry)>0){
        $username = $_POST["username"];
        $form_username = "none";
        $form_password = "block";
    }else{
        $msg_username = '<div id="login-alert" class="alert alert-danger col-sm-12">Username is incorrect</div>';
        
        $form_username = "block";
        $form_password = "none";
    }
}
    
else if(isset($_POST["btn_password"])) {
    $qry = mysqli_query($con, "SELECT password FROM admin WHERE admin_name='".mres($con,$_POST["username"])."' and password='".md5(mres($con,$_POST["password"]))."'") or die (mysqli_error($con));
    if(mysqli_num_rows($qry)>0){
        $_SESSION["admin_name"]=$_POST["username"];
        header("location:index.php");
    }else{
        $msg_password = '<div id="login-alert" class="alert alert-danger col-sm-12">Password is incorrect</div>';
        
        $form_username = "none";
        $form_password = "block";
    }
    
}else{
    
    $form_username = "block";
    $form_password = "none";

}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Persada Dunya Distribution Center - Admin Login</title>
    <!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h3>Persada Dunya Distribution Center</h3>
            </div>
        </div>
        <div class="row">
            <nav class="navbar navbar-default">
                  <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <!-- <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Brand</a>
                    </div> -->
                      <ul class="nav navbar-nav navbar-right">
                      <li><a href="../dashboard.php"><span class="glyphicon glyphicon-log-out"></span> Dashboard</a></li>
                    </ul>
                  </div><!-- /.container-fluid -->
                </nav>
        </div>
        <div class="row">
           <div class="container">
            <div id="loginbox" style="margin-top: 50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
               <div class="panel panel-info" style="display: <?php echo $form_username; ?>">
                   <div class="panel-heading">
                       Admin Login: Username
                   </div>
                   <div class="panel-body">
                       <?php echo $msg_username; ?>
                       <form id="form_username" class="form-horizontal" role="form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" >
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                           <input type="text" class="form-control" name="username" id="username" placeholder="Username"> 
                       </div>
                       <div style="margin-top: 10px" class="form-group">
                           <div class="col-sm-12 controls">
                               <input type="submit" id="btn_username" name="btn_username" class="btn btn-info" value="Next">
                            </div>
                       </div>
                    </form>
               </div>
            </div>
             <div class="panel panel-info" style="display: <?php echo $form_password; ?>">
                   <div class="panel-heading">
                       Admin Login: Password
                   </div>
                   <div class="panel-body">
                   <?php echo $msg_password; ?>
                   <form id="form_password" class="form-horizontal" role="form" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                      <input type="hidden" name="username" value="<?php echo $username; ?>">
                       <div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                           <input type="password" class="form-control" name="password" id="password" placeholder="Password"> 
                       </div>
                       <div style="margin-top: 10px" class="form-group">
                           <div class="col-sm-12 controls">
                               <input type="submit" id="btn_password" name="btn_password" class="btn btn-info" value="Login">
                            </div>
                       </div>
                    </form>
               </div>
            </div>
            </div>
            </div>
        </div>
        </div>
        <script>
            $(document).ready(function(){
                $("#btn_username").click(function(e){
                    if($("#username").val() == ''){
                        $("#username").css("border-color","#DA1908");
                        $("#username").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form_username').unbind('submit').submit();
                    }
                });
                
                $("#btn_password").click(function(e){
                    if($("#password").val() == ''){
                        $("#password").css("border-color","#DA1908");
                        $("#password").css("background","#F2DEDE");
                        e.preventDefault();
                    }else{
                        $('form_password').unbind('submit').submit();
                    }
                });
            });
      </script>
  </body>
</html>