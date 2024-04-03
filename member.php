<?PHP
require_once ('CRUD.php');
//Inclusion de la page CRUD.php dans la classe Member
class Member implements CRUD{
    //Déclaration des variables
    private $first_name;
    private $last_name;
    private $matricule;
    private $tranche_age;
    private $sexe;
    private $situation_matrimoniale;
    private $statut;
    private $connexion;


    //Le constructeur avec ses paramétres
    public function __construct($connexion,$first_name, $last_name,$matricule, $tranche_age, $sexe, $situation_matrimoniale, $statut){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->matricule = $matricule;
        $this->tranche_age = $tranche_age;
        $this->sexe = $sexe;
        $this->situation_matrimoniale = $situation_matrimoniale;
        $this->statut = $statut;
        $this->connexion = $connexion;
    }
    public function getFirst_name() {
        return $this->first_name;
    }
    public function getLast_name() {
        return $this->last_name;
    }
    public function getMatricule() {
        return $this->matricule;
    }
    public function getTranche_age() {
        return $this->tranche_age;
    }
    public function getSexe() {
        return $this->sexe;
    }
    public function getSituation_matrimoniale() {
        return $this->situation_matrimoniale;
    }
    public function getStatut() {
        return $this->statut;
    }

    //Déclaration des méthodes
    public function addMember($first_name, $last_name, $matricule, $tranche_age, $sexe, $situation_matrimoniale, $statut){
        $sql = "INSERT INTO Member (first_name, last_name, matricule, tranche_age, sexe, situation_matrimoniale, statut) VALUES (:first_name, :last_name, :matricule, :tranche_age, :sexe, :situation_matrimoniale, :statut)";
    
        //Préparation de la requête
        try {
            $requete = $this->connexion->prepare($sql);
    
            //Liaison des valeurs et des paramètres
            $requete->bindParam(':first_name', $first_name);
            $requete->bindParam(':last_name', $last_name);
            $requete->bindParam(':matricule', $matricule);
            $requete->bindParam(':tranche_age', $tranche_age, PDO::PARAM_STR); // Spécifier le type de paramètre
            $requete->bindParam(':sexe', $sexe);
            $requete->bindParam(':situation_matrimoniale', $situation_matrimoniale);
            $requete->bindParam(':statut', $statut);
    
            //Exécution de la requête
            $requete->execute();
    
            //redirection vers la page index.php
            header('Location: index.php');
    
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion de l'enregistrement : " . $e->getMessage();
        }
    }
    

    public function deleteMember($id){
        try{
            $sql="DELETE FROM Member WHERE id= :id";
            $stmt=$this->connexion->prepare($sql);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            header('location:index.php');
        }catch(PDOException $e){
    
            die("erreur: impossible de faire la suppression" .$e->getMessage());
        }
            
        }
    
    
        public function updateMember($id, $first_name, $last_name, $matricule, $tranche_age, $sexe, $situation_matrimoniale, $statut) {
            try {
                // Requête SQL UPDATE pour mettre à jour les informations du membre
                $sql = "UPDATE Member SET first_name = :first_name, last_name = :last_name, matricule = :matricule, tranche_age = :tranche_age, sexe = :sexe, situation_matrimoniale = :situation_matrimoniale, statut = :statut WHERE id = :id";
        
                // Préparation de la requête
                $stmt = $this->connexion->prepare($sql);
        
                // Liaison des valeurs aux paramètres
                $stmt->bindParam(':first_name', $first_name);
                $stmt->bindParam(':last_name', $last_name);
                $stmt->bindParam(':matricule', $matricule);
                $stmt->bindParam(':tranche_age', $tranche_age);
                $stmt->bindParam(':sexe', $sexe);
                $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale);
                $stmt->bindParam(':statut', $statut);
                $stmt->bindParam(':id', $id);
        
                // Exécution de la requête
                $stmt->execute();
        
                // Redirection vers la page index.php après la mise à jour
                header("Location: index.php");
                exit();
            } catch (PDOException $e) {
                echo "Erreur lors de la mise à jour de l'enregistrement : " . $e->getMessage();
            }
        }
        
    public function readMember(){
        try{
            //Requête d'insertion
            $sql= "SELECT * FROM Member";
            //Préparation de la requête
            $stmt=$this->connexion->prepare($sql);
            //Exécution de la requete
            $stmt->execute();

            //Récupération des données
            $resultat=$stmt->fetchALL(PDO::FETCH_ASSOC);
            return $resultat;
        }
        catch(PDOException $e){
            echo "Erreur: " . $e->getMessage();
        }
    }

    public function afficher(){
        try{
            //Requete sql
            $sql = "SELECT * FROM Member WHERE :id = id";
        }catch(PDOException $e){

        }
    }
}

