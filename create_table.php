<?php
    include("include/db.php");
    $pdo = connectToDB(); //Establish database connection

    //Create the users table
    $sql = "CREATE TABLE users(
        user_id INT AUTO_INCREMENT,
        username VARCHAR(100) NOT NULL,
        added_at DATETIME NOT NULL DEFAULT (CURRENT_TIMESTAMP()),
        PRIMARY KEY(user_id)
    );";

    try{
        $pdo->exec($sql);

        if(checkDebug()) output("Table 'users' created successfully!");
        
    } catch( PDOException $e){
        if(checkDebug()) output($e->getMessage());
    }

    
?>