<?php
    session_start();
    if(isset($_GET['logout'])) {
        session_unset('validUser');
        session_destroy();
        header("Location: home.php");
    }
?>