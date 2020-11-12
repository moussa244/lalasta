<?php
/**
* 
*/
require_once 'DbMgr.php';
class Abonne
{
	private $id;
    private $nom_entreprise;
    private $nom_complet;
    private $email;
    private $numero_tel;
    private $lien_site;
    private $id_categorie;
	function __construct()
	{
		
	}
	function getId() {
        return $this->id;
    }
    function setId($id) {
        $this->id = $id;
    }
    function getNom_entreprise() {
        return $this->nom_entreprise;
    }
    function setNom_entreprise($nom_entreprise) {
        $this->nom_entreprise = $nom_entreprise;
    }
    function getNom_complet() {
        return $this->nom_complet;
    }
    function setNom_complet($nom_complet) {
        $this->nom_complet = $nom_complet;
    }
    function getEmail() {
        return $this->email;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function getNumero_tel() {
        return $this->numero_tel;
    }
    function setNumero_tel($numero_tel) {
        $this->numero_tel = $numero_tel;
    }
    function getLien_site() {
        return $this->lien_site;
    }
    function setLien_site($lien_site) {
        $this->lien_site = $lien_site;
    }
    function getId_categorie() {
        return $this->id_categorie;
    }
    function setId_categorie($id_categorie) {
        $this->id_categorie = $id_categorie;
    }
    public function insertProspect($nom_entreprise, $nom_complet, $email, $numero_tel, $lien_site)
    {
        $db = new DbMgr();
        $sql = "SELECT  id FROM prospect WHERE email = :email;";
        $param = array('email'=>$email);
        $id = $db->execute($sql, $param);
        $row = $id->fetch(PDO::FETCH_BOTH);
        if ($row) {
            return $row['id'];
        }
        $sql = "INSERT INTO prospect VALUES(NULL, :nomEps, :nom, :email, :num, :lien_site);";
        $param = array('nomEps'=>$nom_entreprise, 'nom'=>$nom_complet, 'email'=>$email, 'num'=>$numero_tel, 'lien_site'=>$lien_site);
        $db->execute($sql, $param);
        return $db->get_lastInsertId();
    }
    public function insertDevis($id_categorie, $id_sous_categorie, $id_client)
    {
        $db = new DbMgr();
        $sql = "INSERT INTO devis VALUES(NULL, :id_categorie, :id_sous_categorie, :id_client, :status);";
        $param = array('id_categorie'=>$id_categorie, 'id_sous_categorie'=>$id_sous_categorie, 'id_client'=>$id_client, 'status'=>0);
        return $db->execute($sql, $param);
    }
    public function insertMessage($message, $id_prospect, $date_envoie)
    {
        $db = new DbMgr();
        $sql = "INSERT INTO message VALUES(NULL, :message, :id_prospect, :status, :date_envoie);";
        $param = array('message'=>$message, 'id_prospect'=>$id_prospect, 'status'=>0, 'date_envoie'=>$date_envoie);
        return $db->execute($sql, $param);
    }


}
?>
