<?php

class Reservation {
    private string $id_emprunt;
    private string $id_equip;
    private string $id_user;
    private string $dateDebut;
    private string $dateFin;
    private float $prix;
    private int $quantite;

    // Constructeur
    public function __construct(string $id_emprunt, string $id_equip, string $id_user, string $dateDebut, string $dateFin, float $prix, int $quantite) {
        $this->id_emprunt = $id_emprunt;
        $this->id_equip = $id_equip;
        $this->id_user = $id_user;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->prix = $prix;
        $this ->quantite = $quantite;
        
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

    // Getter pour prix
    public function getPrix(): float {
        return $this->prix;
    }
    // Getter pour quantite
    public function getQuantite(): int {
        return $this->quantite;
    }
}
?>
