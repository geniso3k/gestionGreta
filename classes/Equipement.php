<?php

class Equipement {
    private string $code;
    private string $libelle;
    private ?string $categorie ;
    private ?string $desc;

 
        //Constructeur
        function __construct(string $code, string $libelle, string $c = null, $d = null){
            $this->code = $code;
            $this->libelle = $libelle;
            $this->categorie = $c;
            $this ->desc = $d;
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
    public function getDescription(){
        return $this->desc;
    }
}