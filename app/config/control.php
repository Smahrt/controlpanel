<?php
    $exAfter = 30 * 60;

    if(isset($_SESSION['last_action'])){
        $inactive = time() - $_SESSION['last_action'];
        
        if($inactive >= $exAfter){
            session_unset();
            session_destroy();
            
            header("Refresh: 0");
        }
    }

    $_SESSION['last_action'] = time();
?>