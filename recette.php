<?php

    require "index.php";
    require "header.php";

?>

<main>
    <div class="formRecette">
        <h1>Ajouter votre recette !</h1>
        <form action="recette.php">
            <div>
                <label for="composant">Nom</label>
                <input type="text" id="composant" name="composant" required>
            </div>
            <div>
                <label for="composant">Ingrédients</label>
                <input type="text" id="composant" name="composant" required>
            </div>
            <div>
                <label for="description">Description</label>
                <input type="text" id="description" name="description" required>
            </div>
            <div>
                <label for="cout">Durée</label>
                <input type="number" id="cout" name="cout" required>
            </div>
            <button type="submit">Partager</button>
        </form>
    </div>
    
</main>


<?php
    require "footer.php";
?>