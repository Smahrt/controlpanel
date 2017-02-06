<?php

    include ('config/config.php');
    
    //fetch Information of the user
    $user_check = $_SESSION['login_user'];

    $sql="SELECT * FROM users WHERE username='$user_check'";
    $result=$dbh->query($sql);
    $user_log =$result->fetch(PDO::FETCH_ASSOC);

    $login_session = $user_log['username'];
    $role = $user_log['role'];
    if(!isset($user_check)){
        //$dbh=null;
       //header('location:index.php');
    }

    function tables(){
        echo"helo";
    }
    
?>