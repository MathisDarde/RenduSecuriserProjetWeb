<?php 

session_start();

if(!isset($_POST["token"]) || $_POST['token'] != $_SESSION['csrf_article_add']){
    die('<p>CSRF invalide</p>');
}

unset($_SESSION['csrf_article_add']);

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

if(isset($email) && isset($password)) {
    require_once 'bdd.php';

    $query = $connexion->prepare('SELECT id, password, admin FROM user WHERE mail = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];

        echo '<p>Connexion réussie. Bienvenue, ' . htmlspecialchars($email) . '!</p>';
        header('Location: article.php');
        exit();
    } else {
        echo '<p>Identifiants invalides.</p>';
    }
} else {
    echo '<p>Le pseudo et le mot de passe sont obligatoires.</p>';
}
?>
