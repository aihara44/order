<?php

include ("../connection.php");
//fetch.php
if(isset($_POST["tahun_id"]) && !empty($_POST["tahun_id"])){
    $query = $con->query("SELECT * FROM bulan WHERE tahun_id = ".$_POST['tahun_id']);
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        echo '<option value="">-- Select Month --</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['bulan_id'].'">'.$row['bulan'].'</option>';
        }
    }else{
        echo '<option value="">-- Select Month --</option>';
    }
}
if(isset($_POST["bulan_id"]) && !empty($_POST["bulan_id"])){
    $query = $con->query("SELECT * FROM blok WHERE bulan = ".$_POST['bulan_id']);
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        echo '<option value="">-- Select Block --</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['blok_id'].'">'.$row['blok'].'</option>';
        }
    }else{
        echo '<option value="">-- Select Block --</option>';
    }
}
if(isset($_POST["block_id"]) && !empty($_POST["block_id"])){
    $query = $con->query("SELECT * FROM tingkat WHERE blok = ".$_POST['block_id']);
    $rowCount = $query->num_rows; 
    if($rowCount > 0){
        echo '<option value="">-- Select Level --</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['tingkat_id'].'">'.$row['tingkat'].'</option>';
        }
    }else{
        echo '<option value="">-- Select Level --</option>';
    }
}
if(isset($_POST["level_id"]) && !empty($_POST["level_id"])){
    $query = $con->query("SELECT * FROM unit WHERE tingkat = ".$_POST['level_id']);
    $rowCount = $query->num_rows; 
    if($rowCount > 0){
        echo '<option value="">-- Select Unit --</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['unit_id'].'">'.$row['unit'].'</option>';
        }
    }else{
        echo '<option value="">-- Select Unit --</option>';
    }
}
?>