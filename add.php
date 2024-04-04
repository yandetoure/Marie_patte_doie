
<?php

//Inclusion de la page de configuration et de la page member et du header
require_once 'header.php';
require_once 'config.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
//Récupération des données du formulaire
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $matricule = $_POST['matricule'];
    $tranche_age = $_POST['tranche_age_id'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $statut = $_POST['id_status'];

        //Appel de la methode addMember
        $member->addMember($first_name,$last_name,$matricule,$tranche_age,$sexe,$situation_matrimoniale,$statut);
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
    <!--Formulaire pour ajouter un membre avec des selects -->
    <div class="container mt-5">
        <h2 class="mb-4">Ajouter un nouveau membre</h2>
        <form method="POST" action="add.php">
            <div class="form-group">
                <label for="matricule">Matricule:</label>
                <input type="text" class="form-control" id="matricule" name="matricule">
            </div>
            <div class="form-group">
                <label for="first_name">Prénom:</label>
                <input type="text" class="form-control" id="first_name" name="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">Nom:</label>
                <input type="text" class="form-control" id="last_name" name="last_name">
            </div>
            <div class="form-group">
    <label for="tranche_age">Tranche d'âge:</label>
    <select class="form-control" id="tranche_age" name="tranche_age_id">
        <option value="10-15">0 - 10 ans</option>
        <option value="15-20">10 - 18 ans</option>
        <option value="18-35">18 - 35 ans</option>
        <option value="35-45">35 - 45 ans</option>
        <option value="45-65">45 - 65 ans</option>
        <option value="65+">65 ans et plus</option>
    </select>
</div>
            <div class="form-group">
                <label for="sexe">Sexe:</label>
                <select class="form-control" id="sexe" name="sexe">
                    <option value="Masculin">Masculin</option>
                    <option value="Féminin">Féminin</option>
                </select>
            </div>
            <div class="form-group">
    <label for="situation_matrimoniale">Situation matrimoniale:</label>
    <select class="form-control" id="situation_matrimoniale" name="situation_matrimoniale">
        <option value="Célibataire">Célibataire</option>
        <option value="Marié(e)">Marié(e)</option>
        <option value="Divorcé(e)">Divorcé(e)</option>
        <option value="Veuf(e)">Veuf(ve)</option>
    </select>
</div>
<div class="form-group">
    <label for="statut">Statut:</label>
    <select class="form-control" id="statut" name="statut">
        <option value="Chef de quartier">Chef de quartier</option>
        <option value="Civile">Civile</option>
        <option value="Badian gokh">Badian gokh</option>
    </select>
</div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
