<?PHP
require_once ('CRUD.php');
//Inclusion de la page CRUD.php dans la classe Member
class Member implements CRUD{
    //Déclaration des variables
    private $first_name;
    private $last_name;
    private $tranche_age;
    private $sexe;
    private $situation_matrimoniale;
    private $statut;
    private $connexion;


    //Le constructeur avec ses paramétres
    public function __construct($connexion,$first_name, $last_name, $tranche_age, $sexe, $situation_matrimoniale, $statut){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->tranche_age = $tranche_age;
        $this->sexe = $sexe;
        $this->situation_matrimoniale = $situation_matrimoniale;
        $this->statut = $statut;
        $this->connexion = $connexion;
    }

    //Déclaration des méthodes
    public function addMember($first_name, $last_name, $tranche_age, $sexe, $situation_matrimoniale, $statut){
        $sql= "INSERT INTO Member (first_name,last_name,tranche_age,sexe,situation VALUES(:first_name,:last_name,:sexe,:situation_matrimoniale,:statut)";

        //Préparation de la requête
        $stmt = $this->connexion->prepare($sql);

        //Liaison des valeurs et des paramétres
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':sexe', $sexe);
        $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale);
        $stmt->bindParam(':statut', $statut);

        //Exécution de la requête
        $stmt->execute();
        //redirection vers la page index.php
        header('Location: index.php');
    }

    public function deleteMember($id){
    }  
    
    public function updateMember($first_name, $last_name, $tranche_age, $sexe, $situation_matrimoniale, $statut){
    }
    public function readMember(){
        try{
            //Requête d'insertion
            $sql= "SELECT * FROM Student";
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
}
