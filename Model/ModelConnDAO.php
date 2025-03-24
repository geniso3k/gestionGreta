<?php
include_once("./Data/ConnexionDB.php");

class ModelConnDAO{


    public static function exist(string $email){
        $requete = ConnexionDB::getInstance()->prepare("SELECT * FROM utilisateur WHERE email = ? LIMIT 1");
        $requete->execute(array($email));
        return ($requete->rowCount()>0);
    }

    public static function updateRole($role, $id){

        $req = ConnexionDB::getInstance()->prepare("UPDATE utilisateur SET role = ? WHERE id = ?");
        $reponse = $req ->execute(array($role, $id));

        if($reponse){
            return true;
        }else{
            return false;
        }


    }
    public static function login(string $user, string $pass){
        
        $requete = ConnexionDB::getInstance()->prepare("SELECT * FROM utilisateur WHERE email = ? LIMIT 1");
        $requete->execute(array($user));

        if($requete->rowCount() > 0){
            $row = $requete->fetch(PDO::FETCH_ASSOC);
            $hashMDP = $row['password'];

            if(password_verify($pass, $hashMDP)){

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                return true;
            }else{

                return false;
            }
        }else{

            return false;
        }
    }
    public static function getClientNom($id){

        try{

            $req = ConnexionDB::getInstance()->prepare("SELECT nom, prenom FROM utilisateur WHERE id = ?");
            $req ->execute(array($id));
            $row = $req->fetch();
            return "Mr/Mme ".strtoupper($row['nom'])." ".$row['prenom'];

        }catch(PDOException $ex){
            print "Erreur : ". $ex->getMessage();
            die();
        }

    }
    public static function register(string $nom, string $prenom, string $email, string $password,string $confirmpass){
        if(self::exist($email)){
            return false; // l'email est déjà utilisé
        }
        

        if ($password !== $confirmpass) {
            return false; // Les mots de passe ne correspondent pas
        }
 

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $requete = ConnexionDB::getInstance()->prepare("INSERT INTO utilisateur  (nom, prenom, email, password) VALUES (?,?,?,?)");
            $succes = $requete->execute(array($nom, $prenom, $email, $hashedPassword));

            return $succes;


    }


    public static function getUsers($start, $perPage) {
        $sql = "SELECT id,email,role FROM utilisateur LIMIT :start, :perPage";
        $stmt = ConnexionDB::getInstance()->prepare($sql);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getTotalUsers() {
        $sql = "SELECT COUNT(*) FROM utilisateur";
        $stmt = ConnexionDB::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public static function getRoleNom($id){
        $sql = ConnexionDB::getInstance()->prepare("SELECT libelle FROM role where id = ?");
        $sql -> execute(array($id));
        while($row = $sql->fetch()){
            return $row['libelle'];
        }
    }

    public static function supprimerUser($id){
        $req = ConnexionDB::getInstance()->prepare("DELETE FROM utilisateur WHERE id = ?");
        $res = $req->execute(array($id));

        if($res){
            return true;
        }else{
            return false;
        }
    }
}
?>

    
