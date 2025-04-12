<?php

class Database{
    private $host = 'localhost';
    private $dbname = 'landingpage';
    private $user = 'root';
    private $password = '';
    private $pdo;


    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : ". $e->getMessage());
        }
    }


    public function emailExist(){
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetchColumn();

        return $result > 0;

    }

    public function insertUser($utilisateur){

        if ($this->emailExist($utilisateur->getEmail())){
            throw new Exception ("Cet email existe déjà");
        }

        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (email, password) VALUES (:email, :password)");

        $email = $utilisateur->getEmail();
        $password = password_hash($utilisateur->getPassword(), PASSWORD_BCRYPT);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        header('Location: confirmation.php');


    }

}