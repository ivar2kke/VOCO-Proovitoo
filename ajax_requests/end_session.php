<?php
    //Destroys the session
    session_start();
    include("../include/functions.php");

    $_SESSION = [];
    session_destroy();
    sendJSONResponse("", "success");

?>