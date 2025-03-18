<?php

class Reservation {
    private string $id_emprunt;
    private string $id_equip;
    private string $id_user;
    private string $dateDebut;
    private string $dateFin;
    private string $signature;


    // Constructeur
    public function __construct(string $id_emprunt, string $id_equip, string $id_user, string $dateDebut, string $dateFin, string $signature) {
        $this->id_emprunt = $id_emprunt;
        $this->id_equip = $id_equip;
        $this->id_user = $id_user;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->signature = $signature;

        
    }

    public function getSignature(){
        return $this->signature;
    }
    // Getter pour id_emprunt
    public function getIdEmprunt(): string {
        return $this->id_emprunt;
    }

    // Getter pour id_equip
    public function getIdEquip(): string {
        return $this->id_equip;
    }

    // Getter pour id_user
    public function getIdUser(): string {
        return $this->id_user;
    }

    // Getter pour dateDebut
    public function getDateDebut(): string {
        return $this->dateDebut;
    }

    // Getter pour dateFin
    public function getDateFin(): string {
        return $this->dateFin;
    }


}
?>
