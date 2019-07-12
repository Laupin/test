<?php require_once('inc/header.inc.php') ?>

<h1>Livre</h1>

<a href="?affichage">Affiche les livres</a> <br>
<a href="?ajout">Ajouter un livre</a>

<?php
//----------------------------
// Pour action affichage
if( isset($_GET['affichage']) ) :?>
	<?php
        // Affichage de la table livre
        $content .= "<h2>Affichage des livres</h2>";
        $r = execute_requete(" SELECT * FROM `livre` ORDER BY `id_livre` ASC  ");
        $content .=  "<table class='table'>";
    
	       $content .= "<tr>";
            $content .= "<td>id_livre</td>";
			$content .= "<td>auteur</td>";
			$content .= "<td>titre</td>";
            $content .= "<td>photo</td>";
		$content .= "</tr>";
		
        while( $livre = $r->fetch(PDO::FETCH_ASSOC) ){
			//debug($categorie);
			$content .= "<tr>";
				$content .= "<td>$livre[id_livre]</td>";
				$content .= "<td>$livre[auteur]</td>";
				$content .= "<td>$livre[titre]</td>";
                $content .= "<td><img src='$livre[photo]' width='200'></td>";
			$content .= "</tr>";
			}
        $content .= "</table>"		;	
    ?>
<?php 
//------------------------------------
// Pour afficher formulaire /ajout
elseif( isset($_GET['ajout']) ) : ?>
    <h2>Ajouter un livre</h2>
    
    <form method="post" action="?ajout">

      
        <div class="form-group col-3">
            <label for="titre">Titre</label><br>
            <input  class="form-control"  type="text" name="titre" value="titre">
        </div>
        
        <div class="form-group col-3">
            <label for="auteur">Auteur</label><br>
            <input  class="form-control" type="text" name="auteur" value="auteur">
        </div>
        
        <button type="submit" class="btn btn-primary" >Ajouter </button>
	</form>
    <?php
	///-------------------------------
	//Quand on apuie sur le bontout submit ajout
	if( isset($_GET['ajout']) && isset($_POST) && !empty($_POST)  ){
        foreach ($_POST as $key => $value) {

		$_POST[$key] = htmlentities (addslashes($value));
	   }    
        
		debug( $_POST);
        
        		$r = execute_requete(" INSERT INTO `livre`( `auteur`, `titre`) VALUES ( UPPER('$_POST[auteur]'), '$_POST[titre]')" );

	}
?>
<?php endif; ?>

<?= $content ?>

<?php require_once('inc/footer.inc.php') ?>