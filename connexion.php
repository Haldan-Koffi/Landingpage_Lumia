<?php
    require "index.php";
    require "header.php";
?>

<main>

    <?php
        require_once "Class/Database.php";
        require_once "Class/Utilisateur.php";

        $database = new Database();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' ){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if($database->login($email, $password)){
                echo "Connexion réussi";
                header('Location:confirmation.php');
                exit();
            } else {
                echo "Email ou mot de passe incorrect";
            }
        }

    ?>

    <div class="formRecette">
        <h1>Connexion</h1>
        <form action="" method="POST">
        <div>
            <input type="email" name="email" id="email" placeholder="Email..." required>
        </div>
        <div>
            <input type="password" name="password" id="password" placeholder="Mot de passe..." required>
        </div>
        <button type="submit">Me connecter</button>
    </form>
    </div>
</main>

<?php
    require "footer.php";
?>