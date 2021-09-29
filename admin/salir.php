<?php


// Finalizar session
$_SESSION["loggedin"] = NULL;
session_reset(); 

if($_SESSION["loggedin"] != true){
    header("location: ../index.php");
    
}

 
?>