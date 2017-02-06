<?php

    session_start();
    include ('../config/config.php');

    $uname = $_POST['username'];
    $_SESSION['edit_this_user'] = $uname;

    header('Location: edit_user.php');

?>
