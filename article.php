<?php

session_start();

if (!isset($_SESSION['csrf_article_add']) || empty($_SESSION['csrf_article_add'])) {
    $_SESSION['csrf_article_add'] = bin2hex(random_bytes(32));
}

if (!isset($_SESSION['user_id'])) {
    die("Utilisateur non connecté");
}

$userId = $_SESSION['user_id'];

require_once 'bdd.php';

$adminCheck = $connexion->prepare('SELECT admin FROM user WHERE id = :user_id');
$adminCheck->execute(['user_id' => $userId]);
$result = $adminCheck->fetch(PDO::FETCH_ASSOC);

if ($result && $result['admin'] == 1) {
    echo "<a href='createarticle.php'>Publier un article</a>";
}

$getArticles = $connexion->prepare('SELECT title, content, slug FROM article');
$getArticles->execute();

if ($getArticles->rowCount() > 0) {
    while ($article = $getArticles->fetch(PDO::FETCH_ASSOC)) {
        echo '<h1>' . htmlspecialchars($article['title']) . '</h1>';
        echo '<p>' . htmlspecialchars($article['content']) . '</p>';
        if ($result && $result['admin'] == 1) {
            echo '<a href="updatearticle.php?s=' . htmlspecialchars($article['slug']) . '">Update article</a>';
        }
        echo '<br>';
        if ($result && $result['admin'] == 1) {
            echo '<a href="deletearticle.php?s=' . htmlspecialchars($article['slug']) . '">Supprimer larticle</a>';
        }
        echo '<hr>'; 
    }
} else {
    echo '<p>Aucun article trouvé</p>';
}

?>