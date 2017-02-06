<?php
    session_start();
    include ('../config/config.php');

    $link_title = $_POST['title'];
    $link_ip = $_POST['ip'];

    $sql = "INSERT INTO aggregators(link_title, ip_address) VALUES('$link_title','$link_ip')";
    $res = $dbh->query($sql);
    
    if($res){
        echo "Success";
    }else{
        echo "Failed";
    }
?>