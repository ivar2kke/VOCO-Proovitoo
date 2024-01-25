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
    function startUserSession($user_id){
        $_SESSION['user_id'] = $user_id;
    }

    //Fetch username from database
    function getUserName($pdo, $id){
        
        $sql = "SELECT `username` FROM `users` WHERE `user_id` = :id LIMIT 1";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        
        try{
            $statement->execute();
            $user = $statement->fetch();
            if($statement->rowCount() > 0){
                return $user['username'];
            }

            return "";
        }catch(PDOException $e){
            checkDebug() ? output($e->getMessage(), "error") : output("Kasutaja andmete leidmine ebaõnnestus. Palun võta ühendust administraatoriga!", "error");
        }
    }
?>