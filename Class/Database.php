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

        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (email, username, password) VALUES (:email, :username, :password)");

        $email = $utilisateur->getEmail();
        $username = $utilisateur->getUsername();
        $password = password_hash($utilisateur->getPassword(), PASSWORD_BCRYPT);
        

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        header('Location: confirmation.php');
    }

    /**
     * Je suis en train de coder une logique d'authentification
     */
    
    public function login($email, $password){
        try {
            $stmt = $this->pdo->prepare("SELECT email, password FROM utilisateur WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            

            $data = $stmt->fetch(PDO::FETCH_ASSOC); //obtenir les résultats sous forme de tableau associatif

            $isPasswordValid = password_verify($password, $data['password']);

                if($data && $isPasswordValid)
                    {
                        session_start();
                        if(empty($_SESSION['count'])){
                            $_SESSION['count'] = 1;
                        } else {
                            $_SESSION['count'] ++;
                        }
                        $_SESSION['email'] = $data['email'];
                        header('Location:dashboard.php');
                        exit();

                    }  else {
                        echo "informations invalides";
                    }
            } catch (PDOException $e){
                die("Erreur de connexion" . $e->getMessage());
            }
        }
}