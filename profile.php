<?php
require_once __DIR__ . '/database/database.php';
$authDB = require_once __DIR__ . '/database/security.php';
$articleDB = require_once __DIR__ . '/database/models/ArticleDB.php';

$articles = [];
$currentUser = $authDB->isLoggedin();
if (!$currentUser) {
  header('Location:/');
}

$articles = $articleDB->fetchUserArticle($currentUser['id']);
// var_dump($articles);
// exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once 'includes/head.php' ?>
  <link rel="stylesheet" href="/public/css/profile.css">
  <title>Mon profil</title>
</head>

<body>
  <div class="container">
    <?php require_once 'includes/header.php' ?>
    <div class="content">
      <h1>Mon espace</h1>
      <h2> Mes informations</h2>
      <div class="info-container">
        <ul>
          <li>
            <strong>Prenom: </strong>
           <p> <?= $currentUser['firstname']  ?></p>
          </li>
          <li>
             <strong>Nom: </strong>
            <p> <?= $currentUser['lastname']  ?></p>
          </li>
          <li>
            <strong>Email: </strong>
            <p> <?= $currentUser['email']  ?></p>
          </li>
        </ul>
      </div>
      <h3> Mes articles</h3>
      <div class="articles-list">
        <ul>
          <?php foreach ($articles as $a) : ?>
            <li>
              <span><?= $a['title'] ?></span>
              <div class="articles-actions">
                <a href="/form-article.php?id=<?= $a['id'] ?>" class="btn btn-secondary btn-small"> Modifier</a>
                <a href="/delete-article.php?id=<?= $a['id'] ?>" class="btn btn-primary btn-small">supprimer</a>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <?php require_once 'includes/footer.php' ?>
  </div>

</body>

</html>