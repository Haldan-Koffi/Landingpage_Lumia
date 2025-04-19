<?php
    require_once "index.php";
    require_once "header.php";
    require_once "Class/Database.php";
    require_once "Class/Utilisateur.php";

    session_start();
    if(empty($_SESSION['count'])){
        $_SESSION['count'] = 1;
    } else {
        $_SESSION['count'] ++;
    }
?>

<main>
    <div class="confCont">
        <h1 class="confIns">Bienvenue ! 🖖</h1>
        <p>Vous avez visité cette page <?php echo $_SESSION['count']; ?> fois</p>
        <a href="landingpage.php"><button>Se déconnecter</button></a>
    </div>
</main>

<?php
    require_once "footer.php";
?>