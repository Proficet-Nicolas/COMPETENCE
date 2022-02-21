<div class="collab">
    <?php 
        include("navbar_collaborateur.php");
    ?>

    <div class="mainscreen">  
        <h1> Gestion des situations professionnelles </h1>

        <?php
            if (!isset($_GET["situationToEdit"]) and !isset($_GET["usedCompetencesSituation"]) or isset($_GET["updateSituationCompetence"])) {
        ?>
        <table class="situations">
            <tr class="topLine">
                <td class="situations" style="font-size:15px; text-align:center; width: 10%; color:white;"> <strong>Créée le</strong></td>
                <td class="situations" style="font-size:15px; text-align:center; width: 49.5%; color:white;"><strong>Nom de la situation</strong></td>
                <td class="situations" style="font-size:15px; text-align:center; width: 10%;color:white; "><strong>Contexte</strong></td>
                <td class="situations" style="font-size:15px; text-align:center; width: 16%;color:white; "><strong>Durée</strong></td>
                <td class="situations" style="font-size:15px; text-align:center; width: 6%;color:white; "><strong>Etat</strong></td>
                <td class="situations" style="width: 10.5%;">&nbsp;</td>
            </tr>

            <?php
                $situations = getSituations($currentUser->Id());
                while ($data = $situations->fetch()) {
            ?>
            <tr>
                <td class="situations"> <?php echo $data["date_creation"] ?> </td>
                <td class="situations" style="text-align:left;"> <?php echo "<strong> Nom : </strong>" . $data["nom"] . "<br><strong>Détails : </strong>" . $data["details"] ?> </td>
                <td class="situations"> <?php echo $data["contexte"] ?> </td>
                <td class="situations"> <?php echo $data["duree"] . " " . $data["type_duree"] . " à partir du " . $data["date_creation"] ?> </td>
                <td class="situations"> <?php echo Etat_convertion($data["etat"]) ?> </td>
                <td class="situations"><a href="?Gestion_Situation=true&amp;situationToDelete=<?php echo $data["id_situation"] ?>"><img src="https://image.flaticon.com/icons/png/512/49/49854.png" height="30px" alt="Supprimer"></a>
                <a href="?Gestion_Situation=true&amp;situationToEdit=<?php echo $data["id_situation"] ?>"><img src="http://simpleicon.com/wp-content/uploads/pencil.png" height="30px" alt="Editer"></a>
                <acronym title="Voir les compétences utilisées">
                    <a href="?Gestion_Situation=true&amp;usedCompetencesSituation=<?php echo $data["id_situation"] ?>"><img src="https://img.icons8.com/ios/452/development-skill.png" height="30px" alt="Editer"></a>
                </acronym>
                </td>
            </tr>
            <?php } ?>
            </table>
        <?php 
            } elseif (!isset($_GET["usedCompetencesSituation"])) { 
                $situationData = getSituationData($_GET["situationToEdit"]);

                while ($dataS = $situationData->fetch()) {
        ?>
            <form class="mainscreen" method="post" action="index.php?Gestion_Situation=true&amp;editedSituation=<?php echo $dataS["id_situation"] ?>">  
                <table style="width:100%">
                <tr>
                    <td class="left">Nom de la situation :</td>
                    <td class="right"><input name="nom_s" type="text" value = "<?php echo $dataS["nom"] ?>"></td>
                </tr>

                <tr>
                    <td class="left">Contexte :</td>
                    <td class="right">
                        <select name="contexte_s">
                            <?php
                                $request = getContexte(); // Récupération des contextes via bdd

                                while ($data = $request->fetch()) {
                                    if ($data["id_contexte"] == $dataS["id_contexte"]) {
                                        echo "<option selected>" . $data["contexte"] . "</option>"; // Affichage du nom du contexte dans une option
                                    }
                                    echo "<option>" . $data["contexte"] . "</option>"; // Affichage du nom du contexte dans une option
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="height:10px"></td>
                </tr>

                <tr>
                    <td class="left">Date de début :</td>
                    <td class="right"> <input type="date" name="datedebut_s" value="<?php echo $dataS["date_debut"] ?>"> </td>
                </tr>

                <tr>
                    <td class="left">Durée :</td>
                    <td class="right"> 
                        <input style="width:3%" type="number" name="duree_s" value="<?php echo $dataS["duree"] ?>"> <?php echo $dataS["type_duree"] ?>
                        <select name="type_duree_s">
                            <option>jour(s)</option>
                            <option>semaine(s)</option>
                            <option>mois</option>
                            <option>an(s)</option>
                        </select> 
                    </td>
                </tr>

                <tr>
                    <td style="height:10px"></td>
                </tr>

                <tr>
                    <td class="left">Détails :</td>
                    <td class="right"><input name="details_s" type="text" value="<?php echo $dataS["details"] ?>"></td>
                </tr>

                <tr>

                <td class="left">Etat de la situation :</td>
                    <td class="right"> 
                        <select name="etat_s">
                            <option value="0">En cours</option>
                            <option value="1">Terminé</option>
                        </select> 
                    </td>
                </tr>
            </table>

            <h2 class="center"> <br>
                Anciennes ressources :
            </h2>

            <?php
                $dataLiens = getLiens($_GET["situationToEdit"]);
                while ($data = $dataLiens->fetch()) {
            ?>
            <div class="box_grise">
            URL : <strong> <?php echo $data["URI"] ?> <br></strong>
            Détails : <strong> <?php echo $data["details"] ?> <br></strong>
            </div> <br>
            <?php
                }
            ?>

            <h2 class="center">
                Nouvelles ressources : <br>
                (Vous devez retaper les anciennes ressources)
            </h2>

            <div id="boxLiens">
                <input id="itemNum"></input>
            </div>

            <?php
                $dataLiens2 = getLiens($_GET["situationToEdit"]);
                while ($data = $dataLiens2->fetch()) { 
            ?>
                <script>
                    initLien()
                </script>
            <?php
                }               
            ?>

            <br>

            <div class="center">
                <button class="center" type="button" onclick="initLien()">
                    <img src="https://cdn.pixabay.com/photo/2016/12/21/17/11/signe-1923369_1280.png" alt="" width="50" height="50">
                </button>
            </div>  


            <br> <br>
            <div class="center">
                <input type="submit" style="font-size:16px; padding:20px; border-radius: 30px;" name="updateSituation" value="Envoyer">
            </div>
        </form>
        <?php }} else { ?>
        <form method="post" action="index.php?Gestion_Situation=true&amp;updateSituationCompetence=true&amp;usedCompetencesSituation=<?php echo $_GET["usedCompetencesSituation"] ?>">
            <div class="tablecompetences">
                <table class="situations"style="width: 100%;">
                    <tr class="topLine">
                        <td class="situations" style="font-size:20px; text-align:center; width:40%; color:white;">Compétences</td>
                    </tr>
                    <?php
                        $dataActivites = getActivites();

                        while ($dataA = $dataActivites->fetch()) {
                            echo "
                                <tr>
                                    <td style='padding:0px; text-align:left;' class='situations'>
                                    <div style='text-align:center; border-bottom: 1px solid black; background-color:lightgrey; padding:5px;'> B" . $dataA["id_bloc"] . ".A" . $dataA["drawID"] . " - " . $dataA["nom"] . "</div>";

                            $dataCompetences = getCompetences($dataA["id_activite"], $dataA["id_bloc"]);
                            while ($dataC = $dataCompetences->fetch()) {
                                $isCompetencesUsedSituation = isCompetencesUsedSituation($dataC["id_competence"], $_GET["usedCompetencesSituation"]);
                                $isUsed = "white;";
                                $isChecked = ""; 

                            while ($dataC2 = $isCompetencesUsedSituation->fetch()) {
                                if(isset($dataC2)) {
                                    $isUsed = "rgb(169, 230, 174)";
                                    $isChecked = "checked";
                                }
                            }

                                echo "<div style='margin: 0px; padding:5px; background-color:" . $isUsed . "'><input " . $isChecked . " type='checkbox' name='". $dataC["id_competence"] . "'> B"  . $dataA["id_bloc"] . ".A" . $dataA["drawID"] . ".C" . $dataC["drawID"]. " - " . $dataC["nom"] . "</div>";
                            }
                        }
                        echo "</td>";
                    ?>
                    </tr>
                </table>

                <br>

                <div class="center">
                    <button class="center" type="submit" style="font-size:16px; padding:20px; border-radius: 30px;" onclick="openForm()">Envoyer</button>
                </div>
            </div>
        </form>
        <?php } ?>
    </div>
</div>