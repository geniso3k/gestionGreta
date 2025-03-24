<?php

class Lieu{

    private int $id;
    private string $libelle;
    
    public function __construct($i, $l){

        $this->id = $i;
        $this->libelle = $l;

    }
    
    public function getId(){
        return $this->id;
    }
    public function getLibelle(){
        return $this->libelle;
    }


}

?>