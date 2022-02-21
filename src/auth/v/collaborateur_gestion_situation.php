<div class="collab">
    <?php 
        include("navbar_collaborateur.php");
    ?>

    <div class="mainscreen">  
        <h1> Gestion des situations professionnelles </h1>
        <h1> GESTIONS </h1> <br>

        <?php
            if (!isset($_GET["situationToEdit"])) {
        ?>
        <table class="situations">
            <tr class="topLine">
                <td class="situations" style="width: 22%;"> <strong>Date de début</strong></td>
                <td class="situations" style="width: 22%;"><strong>Nom de la situation</strong></td>
                <td class="situations" style="width: 22%;"><strong>Contexte</strong></td>
                <td class="situations" style="width: 22%;"><strong>Date de création</strong></td>
                <td class="situations" style="width: 5.5%;">&nbsp;</td>
            </tr>

            <?php
                $situations = getSituations();
                while ($data = $situations->fetch()) {
            ?>
            <tr>
                <td class="situations"> <?php echo $data["date_debut"] ?> </td>
                <td class="situations"> <?php echo $data["nom"] ?> </td>
                <td class="situations"> <?php echo $data["contexte"] ?> </td>
                <td class="situations"> <?php echo $data["date_creation"] ?> </td>
                <td class="situations"><a href="?Gestion_Situation=true&amp;situationToDelete=<?php echo $data["id_situation"] ?>"><img src="https://image.flaticon.com/icons/png/512/49/49854.png" height="30px" alt="Supprimer"></a>
                <a href="?Gestion_Situation=true&amp;situationToEdit=<?php echo $data["id_situation"] ?>"><img src="http://simpleicon.com/wp-content/uploads/pencil.png" height="30px" alt="Supprimer"></a></td>
            </tr>
        </table>
            <?php } ?>
        <?php 
            } else { 
                $situationData = getSituationData($_GET["situationToEdit"]);
        ?>
        <?php } ?>
    </div>
</div>