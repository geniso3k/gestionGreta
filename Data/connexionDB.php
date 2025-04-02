<?php
	/** 
    * Classe d'accès aux données de type singleton
    * qui utilise les services de la classe PDO
    */

   class ConnexionDB{   	
	//Attribut statique
        private static $connexion;

        /**
         * Constructeur privé vide
         */				
        private function __construct(){
            self::$connexion = null; //Utilisation de self et non this car singleton
        }

        /**
        * Méthode statique qui renvoie l'unique instance de Connexion
        **/
        public static function getInstance(){
            if(!self::$connexion){
                try {
                    $serveur = 'mysql:host=db5017546525.hosting-data.io;';
                    $bdd = 'dbname=dbs14057594';   		
                    $user = 'dbu5674762' ; 
                    $mdp = '5d2f6JEAN!?' ;

                    self::$connexion = new PDO($serveur.$bdd, $user, $mdp); 
                    self::$connexion->query("SET CHARACTER SET utf8");
                } catch (PDOException $e) {
                        echo " Error connexion: " . $serveur . " " . $bdd . " " . $user . " " . $mdp . " " . $e->getMessage() ;
                        throw new Exception("Erreur à  la connexion \n" . $e->getMessage());
                }
            }
            return self::$connexion;
        }

        /**
        * Destructeur qui libère l'objet
        **/
        public function __destruct(){
            self::$connexion = null;
        }
     }   
?>