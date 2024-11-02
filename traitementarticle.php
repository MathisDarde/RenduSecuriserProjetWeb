<?php 

session_start();

if(!isset($_POST["token"]) || $_POST['token'] != $_SESSION['csrf_article_add']){
    die('<p>CSRF invalide</p>');
}

unset($_SESSION['csrf_article_add']);

if(isset($_POST['title']) && !empty($_POST['title'])) {
    $title = htmlspecialchars(string: $_POST['title']);
}
else {
    echo "<p>Le titre est obligatoire !</p>";
}

if(isset($_POST['content']) && !empty($_POST['content'])) {
    $content = htmlspecialchars(string: $_POST['content']);
}
else {
    echo "<p>Le contenu est obligatoire !</p>";
}
if(isset($_POST['slug']) && !empty($_POST['slug'])) {
    $slug = htmlspecialchars(string: $_POST['slug']);
}
else {
    echo "<p>Le slug est obligatoire !</p>";
}

if(isset($title) && isset($content) && isset($slug)) {

    require_once 'bdd.php';

    $sauvegarde = $connexion->prepare(
        query: 'INSERT INTO article (title, content, slug) VALUES (:title, :content, :slug)'
    );
    $sauvegarde->execute(params: [
        'title' => $title,
        'content' => $content,
        'slug' => $slug
    ]);

    if($sauvegarde->rowCount() > 0) {
        echo '<p>Sauvegarde effectuée</p>';
        header('Location: article.php');
    exit();
    } else {
        echo '<p>Une erreur est survenue.</p>';
    }
}