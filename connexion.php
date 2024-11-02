<?php

session_start();

if (
    !isset($_SESSION['csrf_article_add']) || 
    empty($_SESSION['csrf_article_add'])
  ){
    $_SESSION['csrf_article_add'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="traitementconnexion.php" method="POST">
        <br>
        <label for="email">Mail:</label>
        <input type="email" name="email" id="email" placeholder="Mail">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Mot de passe">
        <br>
        <input type="hidden" name="token" value="<?= $_SESSION['csrf_article_add']; ?>">
        <input type="submit" name="ajouter" value="Se connecter">
    </form>

    <a href="index.php">Je n'ai pas de compte</a>
</body>
</html>