<?php 

session_start();

//connextion a la bdd :
$pdo = new PDO('mysql:host=localhost;dbname=bibliotheque', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"));

//var_dump($pdo);

//Definition d'une constante : 
define('URL', "http://localhost/up-php/bibliotheque/");

//Déclaration d'une variable :

$content = '';

require_once('fonction.inc.php');
