<?php

/*
Parametres de notre base
*/
$DB_host = 'localhost';
$DB_port = '3306';
$DB_user = 'root';
$DB_pass = 'kaloulou';
$DB_name = 'pool_php_rush';

/*
Connexion a la base, commune a tous les fichiers
*/
try
{
	$dbh = new PDO("mysql:host={$DB_host};port={$DB_port};dbname={$DB_name}",$DB_user,$DB_pass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
	//error_log($err, 3, MYSQL_ERROR_LOG);
}

/*
Creation de l'instance UNIQUE d'objets sauvegardables en base de donnees
*/
include_once 'class.crud.php';

$crud = new crud($dbh);

?>
