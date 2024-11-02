<?php

session_start();

// Vérification du CSRF
if (!isset($_SESSION['csrf_article_add']) || empty($_SESSION['csrf_article_add'])) {
    $_SESSION['csrf_article_add'] = bin2hex(random_bytes(32));
}

if (!isset($_SESSION['user_id'])) {
    die("Utilisateur non connecté");
}

$userId = $_SESSION['user_id'];

if (!isset($_GET['s']) || empty($_GET['s'])) {
    die("Slug non spécifié");
}

$slug = $_GET['s'];

require_once 'bdd.php';

$article = $connexion->prepare('SELECT article_id FROM article WHERE slug = :slug');
$article->bindParam(':slug', $slug, PDO::PARAM_STR);
$article->execute();

$articlefetch = $article->fetch(PDO::FETCH_ASSOC);

if ($articlefetch) {
    $articleId = $articlefetch['article_id'];

    $delete = $connexion->prepare('DELETE FROM article WHERE article_id = :article_id');
    $delete->bindParam(':article_id', $articleId, PDO::PARAM_INT);

    if ($delete->execute()) {
        echo "L'article a été supprimé avec succès.";
        header('Location: article.php');
    } else {
        echo "Une erreur est survenue lors de la suppression de l'article.";
    }
} else {
    echo "Aucun article trouvé avec ce slug.";
}

?>