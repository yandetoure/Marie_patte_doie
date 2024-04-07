<?php

//Inclusion de la page de configuration et de la page member et du header
require_once 'header.php';
require_once 'config.php';
require_once 'member.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    // $id = $_GET['id']; 
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $matricule = $_POST['matricule'];
    $tranche_age = $_POST['id_age'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $statut = $_POST['id_statut'];
    $etat = $_POST['id_etat'];
    // extract($_POST);
    try {
         // Récupération de l'ID du membre à partir de l'URL
         $id = $_GET['id'];
    // Appel de la méthode updateMember
    $member = new Member($connexion, $first_name, $last_name, $matricule, $tranche_age, $sexe, $situation_matrimoniale, $statut,$etat);
    $member->updateMember($id, $first_name, $last_name, $matricule, $tranche_age, $sexe, $situation_matrimoniale, $statut,$etat);
     
    // Rediriger la page vers index.php
    header("location: index.php");
    exit();
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo "Erreur lors de la mise à jour : " . $e->getMessage();
}
}
    


    //    //Appel de la methode addMember
    //     $member->addMember($first_name,$last_name,$matricule,$tranche_age,$sexe,$situation_matrimoniale,$statut,$etat);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un membre</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    // Requête SQL pour sélectionner les données du membre à partir de son ID
    $id = $_GET['id'];
    $sql = "SELECT * FROM Member WHERE id = :id";
    // Préparation de la requête
    $stmt = $connexion->prepare($sql);
    // Liaison des valeurs aux paramètres
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    // Exécution de la requête
    if ($stmt->execute()) {
        // Récupération des données du membre
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        // Affectation des données aux variables
        $first_name = $member['first_name'];
        $last_name = $member['last_name'];
        $matricule = $member['matricule'];
        $tranche_age = $member['id_age'];
        $sexe = $member['sexe'];
        $situation_matrimoniale = $member['situation_matrimoniale'];
        $statut = $member['id_statut'];
        $etat = $member['id_etat'];
    } else {
        echo "Erreur lors de la récupération des données";
    }
    ?>


<!--  -->

    
    
    <!--Formulaire pour ajouter un membre avec des selects -->
    <div class="container mt-5">
        <h2 class="mb-4">Ajouter un nouveau membre</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="matricule">Matricule:</label>
                <input type="text" class="form-control" value="<?php echo $matricule ?>" id="matricule" name="matricule">
            </div>
            <div class="form-group">
                <label for="first_name">Prénom:</label>
                <input type="text" class="form-control" id="first_name" value="<?php echo  $first_name ?>"  name="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">Nom:</label>
                <input type="text" class="form-control" id="last_name" value="<?php echo  $last_name?>" name="last_name">
            </div>
            <div class="form-group">
    <label for="tranche_age">Tranche d'âge:</label>
    <select class="form-control" id="tranche_age" name="id_age">
        <option value="1" <?php if($tranche_age == "1"){ echo "selected";}?> >0 - 10 ans</option>
        <option value="2"  <?php if($tranche_age == "2"){ echo "selected";}?>>10 - 18 ans</option>
        <option value="3" <?php if($tranche_age == "3"){ echo "selected";}?>>18 - 35 ans</option>
        <option value="4" <?php if($tranche_age == "4"){ echo "selected";}?>>35 - 45 ans</option>
        <option value="5" <?php if($tranche_age == "5"){ echo "selected";}?>>45 - 65 ans</option>
        <option value="6" <?php if($tranche_age == "6"){ echo "selected";}?>>65 ans et plus</option>
    </select>
</div>
            <div class="form-group">
                <label for="sexe">Sexe:</label>
                <select class="form-control" id="sexe" name="sexe">
                    <option value="Masculin" <?php if($sexe == "Masculin"){ echo "selected";}?>>Masculin</option>
                    <option value="Féminin" <?php if($sexe == "Féminin"){ echo "selected";}?>>Féminin</option>
                </select>
            </div>
            <div class="form-group">
    <label for="situation_matrimoniale">Situation matrimoniale:</label>
    <select class="form-control" id="situation_matrimoniale" name="situation_matrimoniale">
        <option value="Célibataire" <?php if($situation_matrimoniale == "Celibataire"){ echo "selected";}?>>Célibataire</option>
        <option value="Marié(e)" <?php if($situation_matrimoniale == "Marié(e)"){ echo "selected";}?>>Marié(e)</option>
        <option value="Divorcé(e)" <?php if($situation_matrimoniale == "Divorcé(e)"){ echo "selected";}?>>Divorcé(e)</option>
        <option value="Veuf(e)" <?php if($situation_matrimoniale == "Veuf(e)"){ echo "selected";}?>>Veuf(ve)</option>
    </select>
</div>
<div class="form-group">
    <label for="statut">Statut:</label>
    <select class="form-control" id="statut" name="id_statut">
        <option value="1" <?php if($statut == "1"){ echo "selected";}?>>Chef de quartier</option>
        <option value="2" <?php if($statut == "2"){ echo "selected";}?>  >Civile</option>
        <option value="3" <?php if($statut == "3"){ echo "selected";}?> >Badian gokh</option>
    </select>
</div>
<div class="form-group">
    <label for="id_etat">État:</label>
    <select class="form-control" id="id_etat" name="id_etat">
        <?php
  
$reponse = $connexion->query('SELECT * FROM Etat');
  
while ($donnees = $reponse->fetch())
{
?>
           <option value="<?php echo $donnees['id']; ?>"> <?php echo $donnees['libelle']; ?></option><br><?php
}
  
?>
</select>

</div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</body>

</html>

</html>

