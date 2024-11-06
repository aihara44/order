<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Persada Dunya Distribution Center - Operation Homepage</title>
    <!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 
      
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h3><b>Administrator</b></h3>
            </div>
        </div>
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                     <div class="nav navbar-nav">
                     <li class="active"><a href="index.php">Home</a></li>
                    </div>
                    <div class="nav navbar-nav pull-right">
                    <li><a href="#"><?php echo "Hello: <b>".$_SESSION["admin_name"]."</b>"; ?></a></li>
                    <li><a href="logout.php">Log Out</a></li>
                    </div>
                </div><!-- /.container-fluid -->
            </nav>
        </div>