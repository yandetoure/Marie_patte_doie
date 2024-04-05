<?php
//Inclusion de la page de configuration de la base de données et du header.
include 'config.php';
require_once 'header.php';
if(isset($_GET['id'])){
    $id = $_GET['id']; 
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des membres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .membre-card {
            border: 1px solid #ced4da;
            border-radius: 10px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .membre-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card-body {
            margin-top: 50px;
            text-align: center;
            font-size: 18px;
        }

        .btn {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Information personnelles</h2>
    <div class="row justify-content-center">
        <?php
        // Inclure le fichier de configuration avec les paramètres de connexion à la base de données
        include 'config.php';
        require_once 'header.php';

        try {
            // Requête pour sélectionner tous les membres de la base de données
            // $sql = "SELECT * FROM Member WHERE id = :id";
            $sql = "SELECT * FROM Member
            JOIN Statut ON (Member.id_statut=Statut.id)
            JOIN Etat ON (Member.id_etat=Etat.id)
            JOIN  Tranche_age ON (Tranche_age.id = Member.id_age);
            ";
            $stmt = $connexion->prepare($sql);
             $stmt->bindParam(':id',$id, PDO::PARAM_INT);
            $stmt->execute();
            // return var_dump($id);
            // Vérifier si des membres sont retournés
            if ($stmt->rowCount() > 0) {
                // Afficher les membres dans des cartes Bootstrap
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="col-md-6">';
                    echo '<div class="card membre-card">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title"  > Prenom : <strong> ' . $row['first_name'] . ' </strong> </h5>';
                    echo '<h5 class="card-title"  > Nom : '  . $row['last_name'] . '</h5>';
                    echo '<p class="card-text"Tranche d\'âge : >Tranche d\'âge: ' . $row['libell'] . '</p>';
                    echo '<p class="card-text">Sexe: ' . $row['sexe'] . '</p>';
                    echo '<p class="card-text"Situation matrimoniale : >Situation matrimoniale: ' . $row['situation_matrimoniale'] . '</p>';
                    echo '<p class="card-text"Stutu :>Statut: ' . $row['statut'] . '</p>';
                    echo '<a href="update.php?id=' . $row['id'] . '" class="btn btn-primary">Modifier</a>';  
                    echo '<a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger">Supprimer</a>';   
                    // echo '<a href="detail.php?id=' . $row['id'] . '" class="btn btn-info">Afficher plus</a>';             
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
