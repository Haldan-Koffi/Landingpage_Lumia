<?php
require_once "index.php";
require_once "header.php";

?>

<main>
    <section class="mainContainer">
        <div>
            <h2 class="title">
                Crée ton compte <br>
                pour notre prochaine <br>
                ouverture !
            </h2>
            <p>
                Avec Lumia, tout le monde <br>
                saura comment fabriquer ses propres <br>
                bougies depuis chez soi.
            </p>
        </div>
<?php
    require_once "class/Database.php";
    require_once "class/Utilisateur.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            $utilisateur = new Utilisateur($email, $username, $password);
            $database = new Database();
            $database->insertUser($utilisateur);

            echo "Utilissateur créé avec succès";

        } catch (Exception $e) {

            echo "Erreur : " . $e->getMessage();

        }
    }

?>
        <div class="formContainer">
            <form action="landingpage.php" method="POST">
                <div class="inputForm">
                    <input type="email" name="email" placeholder="Email..." required>
                </div>
                <div class="inputForm">
                    <input type="text" name="username" placeholder="Pseudo..." required>
                </div>
                <div class="inputForm">
                    <input type="password" name="password" placeholder="Mot de passe..." required>
                </div>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </section>
</main>

<?php
    require_once "footer.php";
?>

</body>
</html>