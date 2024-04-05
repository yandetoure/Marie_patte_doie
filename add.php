
<?php
// Inclusion des fichiers nécessaires
require_once 'header.php';
require_once 'config.php';

// Fonction pour générer la matricule
function generateMatricule($lastMatricule) {
    // Récupération du numéro de la dernière matricule
    $lastNumber = intval(substr($lastMatricule, 3)); // Extrait le nombre de la matricule

    // Incrémentation du numéro
    $newNumber = $lastNumber + 1;

    // Formatage du nouveau numéro
    $newMatricule = "PO_" . str_pad($newNumber, 3, "0", STR_PAD_LEFT); // Remplit de zéros à gauche si nécessaire

    return $newMatricule;
}

// Obtention de la dernière matricule de la base de données (exemple)
$lastMatricule = "PO_005"; // Supposons que la dernière matricule est PO_005

// Génération de la nouvelle matricule
$matricule = generateMatricule($lastMatricule);

// Vérifions si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ... Code de validation et d'insertion de données ...
    
}

// Vérifions si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Initialisation du message d'erreur
    $error_message = "";

    // Validation du prénom
    $first_name = trim($_POST['first_name']); // Supprime les espaces au début et à la fin de la chaîne
    if (!preg_match('/^[a-zA-Z\s]+$/', $first_name)) {
        $error_message .= "Le prénom ne doit contenir que des lettres et des espaces.<br>";
    }

    // Validation du nom
    $last_name = trim($_POST['last_name']);
    if (!preg_match('/^[a-zA-Z\s]+$/', $last_name)) {
        $error_message .= "Le nom ne doit contenir que des lettres et des espaces.<br>";
    }


    // Validation de la tranche d'âge
    $tranche_age = filter_var($_POST['tranche_age_id'], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1, 'max_range' => 6)));
    if ($tranche_age === false) {
        $error_message .= "La tranche d'âge sélectionnée n'est pas valide.<br>";
    }

    // Validation du sexe
    $sexe = trim($_POST['sexe']);
    if (!in_array($sexe, array('Masculin', 'Féminin'))) {
        $error_message .= "Le sexe sélectionné n'est pas valide.<br>";
    }

    // Validation de la situation matrimoniale
    $situation_matrimoniale = trim($_POST['situation_matrimoniale']);
    $valid_situations = array('Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(e)');
    if (!in_array($situation_matrimoniale, $valid_situations)) {
        $error_message .= "La situation matrimoniale sélectionnée n'est pas valide.<br>";
    }

    // Validation du statut
    $statut = filter_var($_POST['id_status'], FILTER_VALIDATE_INT);
    if ($statut === false) {
        $error_message .= "Le statut sélectionné n'est pas valide.<br>";
    }

    // Validation de l'état
    $etat = filter_var($_POST['id_etat'], FILTER_VALIDATE_INT);
    if ($etat === false) {
        $error_message .= "L'état sélectionné n'est pas valide.<br>";
    }

    // Si aucune erreur n'a été détectée, nous pouvons procéder à l'insertion des données
    if (empty($error_message)) {
        // Appel de la méthode addMember
        $member->addMember($first_name, $last_name, $matricule, $tranche_age, $sexe, $situation_matrimoniale, $statut, $etat);
    } else {
        // Affichage du message d'erreur
        echo "<div class='alert alert-danger'>$error_message</div>";
    }
}
?>

<!-- Reste du code HTML pour le formulaire -->

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
                <input type="text" class="form-control" id="matricule" name="matricule" value="<?php echo $matricule; ?>" readonly>
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
    <label for="id_age">Tranche d'âge:</label>        
    
    <select name="id_age" id="id_age">
            <?php
            // Connexion à la base de données
            $connexion = new mysqli('localhost', 'root', '', 'Townhall');

            // Vérifier la connexion
            if ($connexion->connect_error) {
                die("La connexion à la base de données a échoué : " . $connexion->connect_error);
            }

            // Requête pour récupérer les catégories depuis la base de données
            $requete = "SELECT id, libelle FROM Tranche_age";
            $resultat = $connexion->query($requete);

           if ($resultat) {
    if ($resultat->num_rows > 0) {
        // Parcourir les résultats et afficher chaque catégorie comme une option dans le menu déroulant
        while ($row = $resultat->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['libelle'] . "</option>";
        }
    } else {
        echo "<option>Aucune catégorie disponible</option>";
    }
} else {
    echo "Erreur lors de l'exécution de la requête : " . $connexion->error;
}
            ?>
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
    <select name="categorie" id="categorie">
            <?php
            // Connexion à la base de données
            $connexion = new mysqli('localhost', 'root', '', 'Townhall');

            // Vérifier la connexion
            if ($connexion->connect_error) {
                die("La connexion à la base de données a échoué : " . $connexion->connect_error);
            }

            // Requête pour récupérer les catégories depuis la base de données
            $requete = "SELECT id, libelle FROM Statut";
            $resultat = $connexion->query($requete);

           if ($resultat) {
    if ($resultat->num_rows > 0) {
        // Parcourir les résultats et afficher chaque catégorie comme une option dans le menu déroulant
        while ($row = $resultat->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['libelle'] . "</option>";
        }
    } else {
        echo "<option>Aucune catégorie disponible</option>";
    }
} else {
    echo "Erreur lors de l'exécution de la requête : " . $connexion->error;
}
            ?>
        </select>
</div>

<div class="form-group">
    <label for="id_etat">Etat:</label>
    <select name="id_etat" id="id_etat">
            <?php
            // Connexion à la base de données
            $connexion = new mysqli('localhost', 'root', '', 'Townhall');

            // Vérifier la connexion
            if ($connexion->connect_error) {
                die("La connexion à la base de données a échoué : " . $connexion->connect_error);
            }

            // Requête pour récupérer les catégories depuis la base de données
            $requete = "SELECT id, libelle FROM Etat";
            $resultat = $connexion->query($requete);

           if ($resultat) {
    if ($resultat->num_rows > 0) {
        // Parcourir les résultats et afficher chaque catégorie comme une option dans le menu déroulant
        while ($row = $resultat->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['libelle'] . "</option>";
        }
    } else {
        echo "<option>Aucune catégorie disponible</option>";
    }
} else {
    echo "Erreur lors de l'exécution de la requête : " . $connexion->error;
}
            ?>
    </select>
</div> 

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>

            <!-- Reste des champs du formulaire -->
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
