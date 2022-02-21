 <div class="collab">
    <?php  
        include("navbar_collaborateur.php");
    ?>

    <div class="mainscreen">
        <?php 
            if (!isset($_GET["createSituation"])) {
        ?>
        <form method="post" action="index.php?createSituation=true;">  
        <div  id="showCollab">
            <h1 style="text-align:center;"> Création de la situation professionnelle </h1>
                <table style="width:100%">
                    <tr>
                        <td class="left">Nom de la situation :</td>
                        <td class="right"><input required name="nom_s" type="text" placeholder="Insérez le nom de la situation"></td>
                    </tr>

                    <tr>
                        <td class="left">Contexte :</td>
                        <td class="right">
                            <select required name="contexte_s">
                                <?php
                                    $request = getContexte(); // Récupération des contextes via bdd

                                    while ($data = $request->fetch()) {
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
                        <td class="right"> <input required type="date" name="datedebut_s"> </td>
                    </tr>

                    <tr>
                        <td class="left">Durée :</td>
                        <td class="right"> 
                            <input required style="width:3%" type="number" name="duree_s">
                            <select required name="type_duree_s">
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
                        <td class="right"><input required name="details_s" type="text" placeholder="Insérez les détails de la situation"></td>
                    </tr>
                </table>

                <h2 class="center"> <br>
                    Ajouter des ressources
                </h2>

                <div id="boxLiens">
                    <input id="itemNum"></input>
                </div>

                <script>
                    initLien()
                </script>

                <br>

                <div class="center">
                    <button class="center" type="button" onclick="initLien()">
                        <img src="https://cdn.pixabay.com/photo/2016/12/21/17/11/signe-1923369_1280.png" alt="" width="50" height="50">
                    </button>
                </div>  

                <br> <br>

                <div class="center">
                    <button class="center" type="button" style="font-size:16px; padding:20px; border-radius: 30px;" onclick="openForm()">Ajouter compétence(s) mobilisée(s)</button>
                </div>
            </div>
            <div style="display:none" id="editComp">
                <button type="button" onclick="closeForm()">Retour</button> <br> <br>
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
                                    $isCompetencesUsed = isCompetencesUsed($dataC["id_competence"], $currentUser->Id());

                                    echo "<div style='margin: 0px; padding:5px;'><input type='checkbox' name='". $dataC["id_competence"] . "'> B"  . $dataA["id_bloc"] . ".A" . $dataA["drawID"] . ".C" . $dataC["drawID"]. " - " . $dataC["nom"] . "</div>";
                                }
                            }
                            echo "</td>";
                        ?>
                        </tr>
                    </table>

                    <br>

                    <div class="center">
                        <button class="center" type="submit" style="font-size:16px; padding:20px; border-radius: 30px;">Envoyer</button>
                    </div>
                </div>
            </div>
        </form>
        <?php
            } else {
        ?>
        <div class="center">
            <a href="index.php">
                <button>Appuyez ici pour renvoyer une réalisation</button>
            </a>
        </div>
        <?php
            }
        ?>
    </div>
</div>

<!-- POPUP -->

