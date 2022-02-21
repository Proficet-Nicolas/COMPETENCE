<div class="admin">
    <?php 
        include("navbar_administrateur.php");
    ?>

    <div class="mainscreen">  
     <div class="box_admin_arondie_statistique">
            <div>
            <H1 style="margin-top:0px;"> Statistiques général </H1>
            </div>
            <div>
                Terminés : <strong>
                    <?php echo Situation_tous_terminer(); ?> <br>
                </strong>
                En cours : <strong>
                    <?php echo Situation_tous_encour(); ?> <br>
                </strong>
                Toutes les situations : <strong>
                    <?php echo Situation_tous(); ?> <br>
                </strong>
            </div>
       </div>
       
       <div class="box_admin_arondie_statistique" style="margin-top:1%;">
            <H1 style="margin-top:0px;"> Statistiques visée </H1>
            <form method="post" action="" >

                <label for="name">Collaborateur à viser :</label>
                <select name="selectCollaborateur_statistique">
                    <?php
                    $AllCollaborateur = getCollaborateur(); // Récupération des contextes via bdd
                    while ($data = $AllCollaborateur->fetch()) {
                        echo "<option>" . $data["id_EGNOM"]. "</option>"; // Affichage du nom du contexte dans une option
                    }
                    ?>
                </select>
                <br>
                <input type="submit" name='find' value="Viser">
            </form>
            <br>

                Terminés : <strong>
                    <?php echo statistique_avancer_cibler_terminer(); ?> <br>
                </strong>
                En cours : <strong>
                    <?php echo statistique_avancer_cibler_encours(); ?> <br>
                </strong>
                Contributions : <strong>
                    <?php echo Contribution_sur_situationAll(); ?>%<br>
                </strong>     
     </div> 
</div>        

