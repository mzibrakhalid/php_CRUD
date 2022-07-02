<?php

try {
    $conn = new PDO("mysql:host=localhost;dbname=crudtest", "root", "");
    //echo "Connexion Etablit";
} catch (PDOException $ex) {
    die("Erreur lors de la connexion:" . $ex->getMessage());
}
