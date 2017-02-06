<?php
    session_start();
    include ('../config/config.php');
    
    $link_id = $_POST['link_id'];
    
    $sql = "DELETE FROM aggregators WHERE id = '$link_id'";
    $res = $dbh->query($sql);
    
    if($res){
        echo "Success";
    }else{
        echo "Failed";
    }
?>