<?php

    // $database= new mysqli("localhost","u968651013_test","#8iPa;ZTAioS","u968651013_test");
    $database= new mysqli("localhost","root","","u968651013_test");
    
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>