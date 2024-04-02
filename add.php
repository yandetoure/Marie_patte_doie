<?php

require_once 'config.php';

if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $tranche_age = $_POST['tranche_age'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $statut = $_POST['statut'];

    if(!empty($first_name) && !empty($last_name) && !empty($sexe) && !empty($situation_matrimoniale) && !empty($statut)){
        
        //Appel de la methode addMember
        $member->addMember($first_name,$last_name,$tranche_age,$sexe,$situation_matrimoniale,$statut);
    }
}