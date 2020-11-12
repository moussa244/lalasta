<?php
require_once 'Devis_lalasta.php';
require_once 'mailMessage.php';
// Check for empty fields
if(empty($_POST['nom'])      ||
   empty($_POST['numero'])     ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
  
$nom = strip_tags(htmlspecialchars($_POST['nom']));
$numero = strip_tags(htmlspecialchars($_POST['numero']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$abonne = new Abonne();
$id_prospect =  $abonne->insertProspect("", $nom, $email, $numero, "");
$abonne->insertMessage($message, $id_prospect, date("Y-m-d H:i:s"));
envoyerMail($email,$nom,$numero,$message);
return true;         
?>