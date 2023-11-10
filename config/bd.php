<?php

    $databaseHost = 'localhost';
    $databaseName = 'parc_informatique';
    $databaseUsername = 'root';
    $databasePassword = '';

    try {

        $db = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", $databaseUsername, $databasePassword);
        
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    } catch(PDOException $e) {

        echo $e->getMessage();
        
    }
 
?>