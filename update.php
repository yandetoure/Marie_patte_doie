<?php

//Inclusion de la page de configuration et de la page member et du header
require_once 'header.php';
require_once 'config.php';
require_once 'member.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $id = $_GET['id']; 
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $matricule = $_POST['matricule'];
    $tranche_age = $_POST['tranche_age'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $statut = $_POST['statut'];

    // Appel de la méthode updateMember
    $member = new Member($connexion, $first_name, $last_name, $matricule, $tranche_age, $sexe, $situation_matrimoniale, $statut);
    $member->updateMember($id, $first_name, $last_name, $matricule, $tranche_age, $sexe, $situation_matrimoniale, $statut);

    // Rediriger la page vers index.php
    header("location: index.php");
    exit();
    
}

       //Appel de la methode addMember
        $member->addMember($first_name,$last_name,$matricule,$tranche_age,$sexe,$situation_matrimoniale,$statut);

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
        $tranche_age = $member['tranche_age'];
        $sexe = $member['sexe'];
        $situation_matrimoniale = $member['situation_matrimoniale'];
        $statut = $member['statut'];
    } else {
        echo "Erreur lors de la récupération des données";
    }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un nouveau membre</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php 
                //requete sql pour selectionner les données de l'etudiant à partir de son id 
                $id = $_GET['id'];
                $sql = "SELECT * FROM Member WHERE id = :id   ";
                //prepareation de la requete
                $stmt=$connexion ->prepare($sql);

                //liaison des valeurs aux parametre
                $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);


                //execution de la requete
                if($stmt->execute()){
                    //preparation du resultat
                    $member=$stmt->fetch(PDO::FETCH_ASSOC);
                    //recuperation des donnés des membres
                     $first_name=$member['first_name'];
                     $last_name=$member['last_name'];
                     $matricule=$member['matricule'];
                     $tranche_age=$member['tranche_age'];
                     $sexe=$member['sexe'];
                     $situation_matrimoniale=$member['situation_matrimoniale'];
                     $statut=$member['statut'];
                }else{
                    echo"Erreur lors de la recuperation des données";
                }
            ?>

    
    
    <!--Formulaire pour ajouter un membre avec des selects -->
    <div class="container mt-5">
        <h2 class="mb-4">Ajouter un nouveau membre</h2>
        <form method="POST" action="update.php?id=<?php echo $id;?>">
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
    <select class="form-control" id="tranche_age" name="tranche_age">
        <option value="10-15" <?php if($tranche_age == "10-15"){ echo "selected";}?> >0 - 10 ans</option>
        <option value="10-18"  <?php if($tranche_age == "10-18"){ echo "selected";}?>>10 - 18 ans</option>
        <option value="18-35" <?php if($tranche_age == "18-35"){ echo "selected";}?>>18 - 35 ans</option>
        <option value="35-45" <?php if($tranche_age == "35-45"){ echo "selected";}?>>35 - 45 ans</option>
        <option value="45-65" <?php if($tranche_age == "45-65"){ echo "selected";}?>>45 - 65 ans</option>
        <option value="65+" <?php if($tranche_age == "65+"){ echo "selected";}?>>65 ans et plus</option>
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
    <select class="form-control" id="statut" name="statut">
        <option value="Chef de quartier" <?php if($statut == "Chef de quartier"){ echo "selected";}?>>Chef de quartier</option>
        <option value="Civile" <?php if($statut == "Civile"){ echo "selected";}?>  >Civile</option>
        <option value="Badian gokh" <?php if($statut == "Badian gokh"){ echo "selected";}?> >Badian gokh</option>
    </select>
</div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</body>

</html>

</html>

