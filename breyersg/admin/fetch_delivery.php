<?php

include ("../connection.php");
//fetch.php
if(isset($_POST["jenama_id"]) && !empty($_POST["jenama_id"])){
    $query = $con->query("SELECT * FROM jenis WHERE jenama = ".$_POST['jenama_id']);
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        echo '<option value="">-- Select Type --</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['jenis_id'].'">'.$row['jenis'].'</option>';
        }
    }else{
        echo '<option value="">-- Select Type --</option>';
    }
}
?>