<?php
session_start();

function logged_in() {
    return (isset($_SESSION['logged_in']));
}

function confirm_logged_in() {
    if (!logged_in()) {
        //redirect_to("index.php");
        return false;
    }
    return true;
}
?>
