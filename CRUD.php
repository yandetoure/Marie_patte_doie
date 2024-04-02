<?PHP
Interface CRUD{
    public function addMember($first_name, $last_name, $matricule, $tranche_age, $sexe, $situation_matrimoniale, $statut);
    public function deleteMember($id);
    public function updateMember($first_name,$last_name,$matricule,$tranche_age,$sexe,$situation_matrimoniale,$statut);
    public function readMember();
}