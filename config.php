<?PHP 

require_once 'member.php';
//Déclarations des variables pour la connexion
$host ="localhost";
$user="root";
$pass= "";
$db = "Town_hall";

try{

    $connexion = new PDO("mysql:host=$host;dbname=$db",$user,$pass);

} catch (PDOException $e) {
    die("Erreur de la connexion à la base de données : ".$e->getMessage());
}