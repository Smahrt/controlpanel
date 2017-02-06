<?php
    session_start();
    include ('../config/config.php');
    
    $uid = $_POST['userid'];
    
    $sql = "DELETE FROM users WHERE username = '$uid'";
    $res = $dbh->query($sql);
    
    if($res){
        echo "Success";
    }else{
        echo "Failed";
    }
?>