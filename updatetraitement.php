<?php
session_start();

// Vérification du CSRF
if (!isset($_SESSION['csrf_article_add']) || empty($_SESSION['csrf_article_add'])) {
    $_SESSION['csrf_article_add'] = bin2hex(random_bytes(32));
}

// Récupérer le slug de l'URL
$slug = isset($_POST['slug']) ? $_POST['slug'] : null;
if ($slug === null) {
    die("Slug non spécifié.");
}

// Vérification des champs du formulaire
if (isset($_POST['title']) && !empty($_POST['title'])) {
    $title = htmlspecialchars($_POST['title']);
} else {
    echo "<p>Le titre est obligatoire !</p>";
}

if (isset($_POST['content']) && !empty($_POST['content'])) {
    $content = htmlspecialchars($_POST['content']);
} else {
    echo "<p>Le contenu est obligatoire !</p>";
}

if (!isset($_SESSION['user_id'])) {
    die("Utilisateur non connecté");
}

$userId = $_SESSION['user_id'];

if (isset($title) && isset($content)) {
    require_once 'bdd.php';

    // Débogage : afficher le slug
    var_dump($slug);

    $article = $connexion->prepare('SELECT article_id FROM article WHERE slug = :slug');
    $article->bindParam(':slug', $slug, PDO::PARAM_STR);
    $article->execute();

    $articlefetch = $article->fetch(PDO::FETCH_ASSOC);

    if ($articlefetch) {
        $articleId = $articlefetch['article_id'];

        $update = $connexion->prepare('UPDATE article SET title = :title, content = :content WHERE article_id = :article_id');
        $update->bindParam(':title', $title, PDO::PARAM_STR);
        $update->bindParam(':content', $content, PDO::PARAM_STR);
        $update->bindParam(':article_id', $articleId, PDO::PARAM_INT);

        if ($update->execute()) {
            echo "L'article a été modifié avec succès.";
            header('Location: article.php');
        } else {
            echo "Une erreur est survenue lors de la modification de l'article.";
        }
    } else {
        echo "Aucun article trouvé avec ce slug.";
    }
}
?>