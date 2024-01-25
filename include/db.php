<?php
    include("functions.php");

    //Establish a database connection
    function connectToDB($ajax_page = false){
        $configs = include("config.php");
        $dsn = "mysql:host=" . $configs['host'] . ";dbname=" . $configs['db_name'] . ";charset=" . $configs['charset'];

        try{
            $pdo = new PDO($dsn, $configs['username'], $configs['password']);

            if($pdo){

                if(checkDebug() && !$ajax_page) output("Database connection successful!"); //Only outputs if debug mode is active and it isn't an AJAX request

                return $pdo;
            }
        } catch (PDOException $e){
            if(checkDebug() && !$ajax_page) output($e->getMessage()); //Only outputs if debug mode is active and it isn't an AJAX request
        }
    }
?>