<?PHP 

require_once 'member.php';
//Déclarations des variables pour la connexion
$host ="localhost";
$user="root";
$pass= "";
$db = "Town_hall";

try{

    $connexion = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
    $membre = new Member ($connexion, "fallou", "niang", "222","","","","");

} catch (PDOException $e) {
    die("Erreur de la connexion à la base de données : ".$e->getMessage());
}