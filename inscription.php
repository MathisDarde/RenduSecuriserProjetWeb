<?php 

session_start();

if(!isset($_POST["token"]) || $_POST['token'] != $_SESSION['csrf_article_add']){
    die('<p>CSRF invalide</p>');
}

unset($_SESSION['csrf_article_add']);

if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
    $pseudo = htmlspecialchars(string: $_POST['pseudo']);
}
else {
    echo "<p>Le pseudo est obligatoire !</p>";
}

if(isset($_POST['email']) && !empty($_POST['email'])) {
    $email = htmlspecialchars(string: $_POST['email']);
}
else {
    echo "<p>Le mail est obligatoire !</p>";
}

if(isset($_POST['password']) && !empty($_POST['password'])) {
    $password = htmlspecialchars(string: $_POST['password']);
    require_once 'password.php';
}
else {
    echo "<p>Le mot de passe est obligatoire !</p>";
}
if(isset($_POST['slug']) && !empty($_POST['slug'])) {
    $slug = htmlspecialchars(string: $_POST['slug']);
}
else {
    echo "<p>Le slug est obligatoire !</p>";
}

if(isset($pseudo) && isset($email) && isset($password) && isset($slug)) {

    require_once 'bdd.php';

    $sauvegarde = $connexion->prepare(
        query: 'INSERT INTO user (pseudo, mail, password, slug) VALUES (:pseudo, :email, :password, :slug)'
    );
    $sauvegarde->execute(params: [
        'pseudo' => $pseudo,
        'email' => $email,
        'password' => $hashedPassword,
        'slug' => $slug
    ]);

    if($sauvegarde->rowCount() > 0) {
        $userId = $connexion->lastInsertId();
    
        $_SESSION['user_id'] = $userId;

        echo '<p>Sauvegarde effectuée</p>';
        header('Location: article.php');
    exit();
    } else {
        echo '<p>Une erreur est survenue.</p>';
    }
}