<?PHP
Interface CRUD{
    public function addMember($first_name, $last_name, $matricule, $tranche_age, $sexe, $situation_matrimoniale, $id_statut,$id_etat);
    public function deleteMember($id);
    public function updateMember($id,$first_name,$last_name,$matricule,$tranche_age,$sexe,$situation_matrimoniale,$id_statut,$id_etat);
    public function readMember();
    public function afficher();
    
}