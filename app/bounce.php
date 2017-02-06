<?php
    session_start();
    include('config/config.php');
    
    $LinkId = $_POST['linkid'];
    $user = $_SESSION['login_user'];
    $user_id = $_SESSION['login_user_id'];
    $time = date('h:i a');

    $sqlid = "SELECT * FROM aggregators WHERE id='$LinkId'";
    $res = $dbh->query($sqlid);
    $linked = $res->fetch(PDO::FETCH_ASSOC);

    $agg_name = $linked['link_title'];
    $agg_ip = $linked['ip_address'];

    $sql ="UPDATE users_stats SET aggregator='$agg_name', access_time='$time' WHERE id = '$user_id'";
    

    if($dbh->query($sql)){
        echo $agg_ip;
    }else{
        echo $user_id;
    }
?>