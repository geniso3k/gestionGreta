<?php

class Equipement {
    private string $code;
    private string $libelle;
    private ?string $categorie ;
    private ?string $stock ;
    private ?string $prix;

 
        //Constructeur
        function __construct(string $code, string $libelle, string $p = null, string $s = null, string $c = null){
            $this->code = $code;
            $this->libelle = $libelle;
            $this->categorie = $c;
            $this ->stock = $s;
            $this ->prix = $p;
        }  
    
    public function getLibelle(){
        return $this->libelle;
    } 
    public function getCode(){
        return $this->code;
    }
    public function getCategorie(){
        return $this->categorie;
    }
    public function getStock(){
        return $this->stock;
    }
    public function getPrix(){
        return $this->prix;
    }
}