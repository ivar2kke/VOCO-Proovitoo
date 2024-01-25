<?php

    //Returns if debug mode is active
    function checkDebug(){
        $configs = include("config.php");
        return $configs['debug'];
    }

    //Outputs message as text
    function output($message){
        echo $message . "<br>";
    }

    //Send JSON response and then exit script.
    function sendJSONResponse($message, $type){
        echo json_encode(["msg" => $message, "type" => $type]);
        exit;
    }

    //Create user session
    function startUserSession($username){
        $_SESSION['username'] = $username;
    }
?>