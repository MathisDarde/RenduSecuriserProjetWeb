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
    <form action="traitementarticle.php" method="POST">
        <br>
        <label for="title">Titre:</label>
        <input type="text" name="title" id="title" placeholder="Titre">
        <br>
        <label for="content">Contenu:</label>
        <input type="textarea" name="content" id="content" placeholder="Contenu">
        <br>
        <label for="slug">Slug:</label>
        <input type="text" name="slug" id="slug" placeholder="Slug de l'article">
        <br>
        <input type="hidden" name="token" value="<?= $_SESSION['csrf_article_add']; ?>">
        <input type="submit" name="ajouter" value="Je publie l'article">
    </form>
</body>
</html>