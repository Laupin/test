<?php require_once('inc/header.inc.php') ?>

<h1>Abonnes</h1>

<a href="?affichage">Affiche les abonnes</a> <br>
<a href="?action=ajouter">Ajouter un abonne</a>

<?php
//---------------------------
// Pour action affichage
if( isset($_GET['affichage']) ) :?>
	<?php
	// Affichage de la table abonne
	$content .= "<h2>Affichage des abonnes</h2>";
	$r = execute_requete(" SELECT * FROM `abonne` ORDER BY `id_abonne` ASC ");
	$content .=  "<table class='table'>";
		$content .= "<tr>";
			$content .= "<td>Id_abonne</td>";
			$content .= "<td>Prenom</td>";
            $content .= "<td>Modification</td>";
            $content .= "<td>Supprimer</td>";
		$content .= "</tr>";

			while( $abonne = $r->fetch(PDO::FETCH_ASSOC) ){
				//debug($categorie);
				$content .= "<tr>";
				$content .= "<td>$abonne[id_abonne]</td>";
				$content .= "<td>$abonne[prenom]</td>";
                    $content .= '<td><a href="?action=modifier&id_abonne='. $abonne['id_abonne'] .'">Modifier</a></td>';

				    $content .= '<td><a href="?action=supprimer&id_abonne='. $abonne['id_abonne'] . '" onclick="return( confirm(\' En êtes vous sur ?\'))">Supprimer</a></td>';
                
				$content .= "</tr>";
			}
	$content .= "</table>";	
 	?>
<?php 
//------------------------------------
// Pour afficher formulaire /ajout ou modifier
elseif( isset($_GET['action']) && ( ( $_GET['action']=='ajouter' ) || ( $_GET['action']=='modifier' ) ) ) : ?>
    <?php 
        if( isset($_GET['id_abonne'] )){
            $r = execute_requete("SELECT * FROM `abonne` WHERE `id_abonne` ='$_GET[id_abonne]' ");
            $abonne_actuel = $r->fetch(PDO::FETCH_ASSOC);
            

        }
            	$prenom =( isset( $abonne_actuel['prenom']) ) ?  $abonne_actuel['prenom'] : '';
    ?>
	<h2>Formulaire pour l'ajout abonnes</h2> 
	<form method="post" enctype="multipart/form-data">
	<div  class="form-group">
	    <label for=prenom>Prenom</label> <br>
		<input  class="form-control col-3" type="text" name="prenom" id="prenom" value="<?= $prenom ?>">
	</div>
       
        <input type="submit" class="btn btn-primary" value="<?php echo ucfirst($_GET['action'] ); ?>"> 

	</form>
<?php
//--------------------------------
// Quand on apuie sur le bontout submit ajout
if (!empty($_POST)) { 

	if( ($_GET['action']=='ajouter')){
        foreach ($_POST as $key => $value) {

		$_POST[$key] = htmlentities (addslashes($value));
	   }        
		debug( $_POST);
 		//echo "$_POST[prenom]" ;
        
		$r = execute_requete(" INSERT INTO abonne(prenom) VALUES ( '$_POST[prenom]' )" );

	}
    elseif( ($_GET['action']=='modifier')){
    debug( $_POST);
        
        $r = execute_requete(" UPDATE `abonne` SET `prenom`='$_POST[prenom]' WHERE `id_abonne`='$_GET[id_abonne]' " );
            header('http://localhost/up-php/bibliotheque/abonne.php?action=affichage');
    }
    
}
?>
<?php endif; ?>

<?php
//--------------------------------
//Suppression : 
	if (isset($_GET['action']) && $_GET['action'] == 'supprimer') {
        
	//Récupération des infos de l'article à suprimer
	$r = execute_requete("SELECT * FROM abonne WHERE id_abonne='$_GET[id_abonne]'");

		$abonne_a_supprimer = $r->fetch(PDO::FETCH_ASSOC);

		//debug($abonne_a_supprimer);

		execute_requete("DELETE FROM abonne WHERE id_abonne= '$_GET[id_abonne]'");

	}
?>

<?= $content ?>
<?php require_once('inc/footer.inc.php') ?>