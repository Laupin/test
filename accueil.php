<?php require_once('inc/header.inc.php') ?>

<h1>Accueil</h1>
<?php
//------------------------------
// Affichage du menu d'acceuil

 ?>
<h2>Bienvenue sur la page d'acceuil</h2>

<a href="<?= URL ?>abonne.php"> Abonnes</a> <br>
<ul>
    <li>
        <a href="<?= URL ?>abonne.php?affichage">Consulter les abonnes</a> <br>
    </li>
    <li>
        <a href="<?= URL ?>abonne.php?ajout">Ajouter les abonnes</a>
    </li>
</ul>
<a href="<?= URL ?>emprunt.php?">Emprunts</a> <br>
<ul>
    <li>
        <a href="<?= URL ?>emprunt.php?affichage">Consulter les emprunts</a> <br>
    </li>
    <li>
        <a href="<?= URL ?>emprunt.php??ajout">Ajouter un emprunt</a>
    </li>
</ul>
<a href="<?= URL ?>livre.php">Livres</a>
<ul>
    <li>
        <a href="<?= URL ?>livre.php?affichage">Consulter les livres</a>
    </li>
    <li>
        <a href="livre.php?ajout">Ajouter un livre</a>
    </li>
</ul>

<?= $content ?>

<?php require_once('inc/footer.inc.php') ?>