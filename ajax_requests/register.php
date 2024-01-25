<?php
    session_start();

    //Establish database connection
    include("../include/db.php");
    $pdo = connectToDB(true);
    if(!$pdo) sendJSONResponse("Kasutaja registreerimine ebaõnnestus! Palun võta ühendust lehekülje administraatoriga", "error");

    $username = htmlspecialchars($_POST['username']);

    //Check if field is empty
    if(!$username){
        sendJSONResponse("Kasutajanimi ei või olla tühi!", "error");
    }

    //Check if username already exists in the database
    $sql = "SELECT * FROM users WHERE username = :username";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);

    try{
        $statement->execute();
    }catch(PDOException $e){
        checkDebug() ? sendJSONResponse($e->getMessage(), "error") : sendJSONResponse("Kasutaja registreerimine ebaõnnestus! Palun võta ühendust lehekülje administraatoriga", "error");
    }

    if($statement->rowCount() > 0){
        sendJSONResponse("Kasutajanimi on juba kasutusel", "error");
    }


    //If username doesn't exist, insert user into the database
    $insert_sql = "INSERT INTO users(username) VALUES (:username)";
    $insert_statement = $pdo->prepare($insert_sql);
    $insert_statement->bindParam(':username', $username, PDO::PARAM_STR);

    try{
        $insert_statement->execute();
        sendJSONResponse("", "success");
    }catch(PDOException $e){
        checkDebug() ? sendJSONResponse($e->getMessage(), "error") : sendJSONResponse("Kasutaja registreerimine ebaõnnestus! Palun võta ühendust lehekülje administraatoriga", "error");
    }

?>