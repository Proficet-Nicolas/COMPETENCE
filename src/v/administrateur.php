<div class="admin">
    <?php 
        include("navbar_administrateur.php");
    ?>

    <div class="mainscreen">

        <div class="box_admin_table">

            <H1> Avancement Situation </H1>
               
            <form method="post" action="" >
                <label for="pet-select">Etat :</label>

                <select name="etat" id="pet-select">
                    <option value="tous"> Tous </option>
                    <option value="0">En cours</option>
                    <option value="1">Terminé</option>
                </select>


                Collaborateur :
                <select name="selectCollaborateur">
                    <?php
                        $AllCollaborateur = getCollaborateur(); // Récupération des contextes via bdd
                        ?><option value="tous"> Tous </option> <?php
                        while ($data = $AllCollaborateur->fetch()) {
                            echo "<option>" . $data["id_EGNOM"]. "</option>"; // Affichage du nom du contexte dans une option
                        }
                    ?>
                </select>

                <input type="submit" name='find' value="Rechercher">
            </form>

            <br> <br>
            
            <table class="situations">
                <tr class="topLine">
                    <td class="situations"> Collaborateur </th>
                    <td class="situations"> Nom </th>
                    <td class="situations"> Compétences mobilisées </th>
                    <td class="situations"> Date de création</th>
                    <td class="situations"> Etat (Situation) </th>
                </tr>

                
                <?php
                $AllSituation = Situation_Avancement();
                while ($data = $AllSituation->fetch()) {
                ?>
                <tr>
                    <td class="situations" style="background:white;"> <?php echo $data['nom_user'] . " " . $data['prenom_user'] ?> </td>
                    <td class="situations" style="background:white;"> <?php echo $data['nom_situation'] ?> </td>
                    <td class="situations" style="background:white;"> <a href="index.php?Competence_mobiliser=true&amp;id_situation= <?php echo $data['id_situation'] ?>" onclick="window.open(this.href); return false;"> <button>Compétences</button> </a></td>
                    <td class="situations" style="background:white;"> <?php echo $data['date_creation'] ?> </td>
                    <td class="situations" style="background:white;"> <?php echo Etat_convertion($data['etat'])?> </td>
                </tr>

            <?php } ?>
            </table>
        
        </div>

    </div>
</div>