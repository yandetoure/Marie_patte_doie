<?php
//Inclusion de la page de configuration de la base de données et du header.
include 'config.php';
require_once 'header.php'
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des membres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Liste des membres</h2>
    <div class="row">
        <?php
        // Inclure le fichier de configuration avec les paramètres de connexion à la base de données

        try {
            // Requête pour sélectionner tous les membres de la base de données
            $sql = "SELECT * FROM Member";
            $stmt = $connexion->prepare($sql);
            $stmt->execute();

            // Vérifier si des membres sont retournés
            if ($stmt->rowCount() > 0) {
                // Afficher les membres dans des cartes Bootstrap
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card membre-card">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['first_name'] . ' ' . $row['last_name'] . '</h5>';
                    echo '<p class="card-text">Tranche d\'âge: ' . $row['tranche_age'] . '</p>';
                    echo '<p class="card-text">Sexe: ' . $row['sexe'] . '</p>';
                    echo '<p class="card-text">Situation matrimoniale: ' . $row['situation_matrimoniale'] . '</p>';
                    echo '<p class="card-text">Statut: ' . $row['statut'] . '</p>';
                    echo ' <a href="update.php?id=' . $row['id'] . '" class="btn btn-primary">Modifier</a>';  
                    echo ' <a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger">supprimer</a>';   
                    echo ' <a href="detail.php?id=' . $row['id'] . '" class="btn btn-info">Afficher plus</a>';             
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Aucun membre trouvé.";
            }
        } catch(PDOException $e) {
            // Gérer les erreurs PDO
            echo "Erreur: " . $e->getMessage();
        }
        // Fermer la connexion à la base de données
        $connexion = null;
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>