<?php
    session_start();
    if(isset($_REQUEST["action"])){
        if($_REQUEST['action'] == "set_session" && isset($_REQUEST['key']) && !empty($_REQUEST['key'])
         && isset($_REQUEST['value']) && !empty($_REQUEST['value'])){
            $_SESSION[$_REQUEST['key']] = $_REQUEST['value'];
        }
    }

?>