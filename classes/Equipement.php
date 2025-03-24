<?php

class Equipement {
    private string $code;
    private string $libelle;
    private ?string $categorie ;
    private ?string $desc;
    private ?string $lieu;

 
        //Constructeur
        function __construct(string $code, string $libelle, string $c = null, $d = null,$l = null){
            $this->code = $code;
            $this->libelle = $libelle;
            $this->categorie = $c;
            $this ->desc = $d;
            $this->lieu = $l;
        }  
    
    public function getLibelle(){
        return $this->libelle;
    } 
    public function getLieu(){
        return $this->lieu;
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