<?php
$con = mysqli_connect("localhost", "root", "", "breyersg") or die ("Cannot connect to database");
function mres ($con,$data){
    return mysqli_real_escape_string($con,rtrim(ltrim($data)));
}
?>