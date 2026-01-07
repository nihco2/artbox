<?php

if(empty($_POST['titre'])
    || empty($_POST['artiste']) 
    || empty($_POST['image']) 
    || empty($_POST['description'])
    || strlen($_POST['description']) < 3 
    || !filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
    header('Location: ajouter.php');
}
else {
    require 'bdd.php';
    $mysqlClient = connexion();

    $sqlQuery = $mysqlClient->prepare('INSERT INTO oeuvres(titre, artiste, image, description) VALUES(?, ?, ?, ?)');
    $sqlQuery->execute([
        htmlspecialchars($_POST['titre']),
        htmlspecialchars($_POST['artiste']),
        htmlspecialchars($_POST['image']),
        htmlspecialchars($_POST['description'])
    ]);

    header('Location: oeuvre.php?id=' . $mysqlClient->lastInsertId());
}