<?php
require_once 'mailDevis.php';
require_once 'Devis_lalasta.php';
// Check for empty fields
if(empty($_POST['nom'])      ||
   empty($_POST['nomEps'])     ||
   empty($_POST['numero'])     ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
  
$categorie = $_POST['devis'];
$sous_categorie = 0;
$nom = strip_tags(htmlspecialchars($_POST['nom']));
$nomEps = strip_tags(htmlspecialchars($_POST['nomEps']));
$numero = strip_tags(htmlspecialchars($_POST['numero']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$message = "";
$lien_site = "";
switch ($categorie) {
	case '1':
		$typeSiteInternet = $_POST['typeSiteInternet'];
		$sous_categorie = $typeSiteInternet;
		switch ($typeSiteInternet) {
			case '1':
				$object = "Votre Devis de Création de Site Internet : Blog";
				$message = "De 130 000f CFA à 150 000f CFA";
				break;
			case '2':
				$object = "Votre Devis de Création de Site Internet : Site Vitrine";
				$message = "180 000f cfa";
				break;
			case '3':
				$object = "Votre Devis de Création de Site Internet : Site Institionnel";
				$message = "325 000f cfa";
				break;
			case '4':
				$object = "Votre Devis de Création de Site Internet : Site sur Mesure";
				$message = "300 000f cfa";
				break;
		}
		break;
	case '2':
		$object = "Votre Devis de Création de Site E-commerce";
		$message = "325 000f cfa";
		break;
	case '3':
		$objectif = $_POST['objectif'];
		$sous_categorie = $objectif;
		switch ($objectif) {
			case '1':
				$object = "Votre Devis Stratégie Digital : vendre plus";
				$message = "10 000cfa/mois";
				break;
			case '2':
				$object = "Votre Devis Stratégie Digital : faire connaitre son produit";
				$message = "5 000f/mois";
				break;
			case '3':
				$object = "Votre Devis Stratégie Digital : faire connaitre son activité";
				$message = "5f cfa / mois";
				break;
			case '4':
				$object = "Votre Devis Stratégie Digital : fidéliser ses clients";
				$message = "15 000 / mois";
				break;
		}
		break;
	case '4':
		$lien_site = $_POST['siteEps'];
		$object = "Votre Devis de Référencement";
		$message = "10 000f cfa / mois";
		break;
}
	$abonne = new Abonne();
	$id_prospect =  $abonne->insertProspect($nomEps, $nom, $email, $numero, $lien_site);
	$abonne->insertDevis((int) $categorie, (int) $sous_categorie, (int) $id_prospect);
	//envoyerMail($email,$nom,$object,$message);
	return true;         
?>