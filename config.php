<?PHP 

require_once 'member.php';
//Déclarations des variables pour la connexion
$host ="localhost";
$user="root";
$pass= "";
$db = "Town_hall";

try{
    
    $connexion = new PDO("mysql:host=$host;dbname=$db",$user,$pass);

    //Déclaration des variables et instanciation de resultat
    $first_name ="";
    $last_name ="";
    $matricule ="";
    $sexe ="";
    $tranche_age ="";
    $situation_matrimoniale ="";
    $statut ="";

    $member = new Member ($connexion, $first_name, $last_name,$matricule,$tranche_age,$situation_matrimoniale,$sexe,$statut);
    $resultat = $member->readMember();

} catch (PDOException $e) {
    die("Erreur de la connexion à la base de données : ".$e->getMessage());
}