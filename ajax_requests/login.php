<?php
    session_start();

    //Establish database connection
    include("../include/db.php");
    $pdo = connectToDB(true);
    if(!$pdo) sendJSONResponse("Sisselogimine ebaõnnestus! Palun võta ühendust lehekülje administraatoriga", "error");

    $username = htmlspecialchars($_POST['username']);

    //Check if field is empty
    if(!$username){
        sendJSONResponse("Kasutajanimi ei või olla tühi!", "error");
    }

    //Check if username exists in the database
    $sql = "SELECT user_id FROM users WHERE username = :username LIMIT 1";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);

    try{
        $statement->execute();
        $user = $statement->fetch();
    }catch(PDOException $e){
        checkDebug() ? sendJSONResponse($e->getMessage(), "error") : sendJSONResponse("Sisselogimine ebaõnnestus! Palun võta ühendust lehekülje administraatoriga", "error");
    }

    //If user doesn't exist, show error
    if($statement->rowCount() <= 0){
        sendJSONResponse("Sellist kasutajat ei eksisteeri!", "error");
    }

    //If user exists, start the session
    startUserSession($user['user_id']);
    sendJSONResponse("", "success");

?>