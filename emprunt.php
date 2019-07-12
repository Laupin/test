<?php require_once('inc/header.inc.php') ?>

<h1>Emprunt</h1>

<a href="?affichage">Affiche les emprunts</a> <br>
<a href="?ajout">Ajouter un emprunt</a>
<!-- -->
<?php
//------------------------------------
// Pour action affichage
if( isset($_GET['affichage']) ) :?>
	<?php
        // Affichage de la table emprunt
        $content .= "<h2>Affichage des emprunt</h2>";
        $r = execute_requete(" SELECT * FROM `emprunt` ORDER BY `id_emprunt` ASC  ");
        
        $content .=  "<table class='table' >";
	       $content .= "<tr>";
			$content .= "<td>id_emprunt</td>";
			$content .= "<td>id_livre</td>";
			$content .= "<td>id_abonne</td>";
			$content .= "<td>date_sortie</td>";
			$content .= "<td>date_rendu</td>";
		$content .= "</tr>";

		while( $emprunt = $r->fetch(PDO::FETCH_ASSOC) ){
			//debug($categorie);
			$content .= "<tr>";
				$content .= "<td>$emprunt[id_emprunt]</td>";
				$content .= "<td>$emprunt[id_livre]</td>";
				$content .= "<td>$emprunt[id_abonne]</td>";
				$content .= "<td>$emprunt[date_sortie]</td>";
				$content .= "<td>$emprunt[date_rendu]</td>";
				$content .= "</tr>";
			}
	$content .= "</table>"		;	
 	?>
<?php 
//------------------------------------
// Pour afficher formulaire /ajout
elseif( isset($_GET['ajout']) ) : ?>
	<h2>Formulaire pour l'emprunt</h2> 
	<form method="post" action="?ajout">
        <br>
        <div class="form-group col-3">
        <label for="id_livre">Quel livre voulez vous empruntez?</label> 
        <select class="form-control" name="id_livre" id="id_livre" >
            <option value=" " select>-- Choisir un livre-- </option>
            <option value="100"> Une vie </option>
            <option value="101"> Bel amie </option>
            <option value="102"> Le père Goriot </option>
            <option value="103"> Le Petit chose </option>
            <option value="104"> La Reine Margot </option>
            <option value="105"> les Trois Mousquetaires </option>
            <option value="106"> Illusion Perdues </option>
        </select> <br>
        </div>
        
        <div class="form-group col-3">
            <label for="id_livre">Qui emprunte le livre?</label> <br>
            <select  class="form-control" name="id_abonne" id="id_abonne" >
                <option value=" " select>-- Choisir un abonne-- </option>
                <option value="1"> Guillaume </option>
                <option value="2"> Benoit </option>
                <option value="3"> Chloe </option>
                <option value="4"> Laura </option>
            </select> <br>
        </div>
        <div class="col-3" >
		    <label for="date_sortie">Date de sortie</label> <br>
		    <input class="form-control" type="date" id="date_sortie" name="date_sortie"><br>
        </div><br>	
        <button type="submit" class="btn btn-primary" >Ajouter </button>
	</form>

	<?php
	///-------------------------------
	//Quand on apuie sur le bontout submit ajout
	if( isset($_GET['ajout']) && isset($_POST) && !empty($_POST)  ){
		//debug( $_POST);
        
       // echo "'$_POST[id_livre]','$_POST[id_abonne]','$_POST[date_sortie]','$_POST[id_livre]','$_POST[date_rendu]'  ";
 
		$r = execute_requete(" INSERT INTO emprunt( `id_livre`, `id_abonne`, `date_sortie`) VALUES ('$_POST[id_livre]','$_POST[id_abonne]','$_POST[date_sortie]' )" );
	}
?>
<?php endif; ?>

<?= $content ?>

<?php require_once('inc/footer.inc.php') ?>