<?php

try {
    $connexion = new PDO(dsn: "mysql:host=localhost; dbname=rendu_securiser_projet_web", username:'root');
} catch(Exception $e){
    die($e->getMessage());
}

?>