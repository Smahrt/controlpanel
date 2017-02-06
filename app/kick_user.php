<?php
session_start();
$megaIP = $_POST['megaIP'];
session_destroy();
    
echo $megaIP;
?>