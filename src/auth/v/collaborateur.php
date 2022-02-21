 <div class="collab">
    <?php 
        include("navbar_collaborateur.php");
    ?>

    <form class="mainscreen" method="post" action="index.php">  
        <h1> Création de la situation professionnelle </h1>
        <table style="width:100%">
            <tr>
                <td class="left">Nom de la situation :</td>
                <td class="right"><input name="nom_s" type="text" placeholder="Insérez le nom de la situation"></td>
            </tr>

            <tr>
                <td class="left">Contexte :</td>
                <td class="right">
                    <select name="contexte_s">
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
                <td class="right"> <input type="date" name="datedebut_s"> </td>
            </tr>

            <tr>
                <td class="left">Durée :</td>
                <td class="right"> 
                    <input style="width:3%" type="number" name="duree_s">
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
                <td class="right"><input name="details_s" type="text" placeholder="Insérez les détails de la situation"></td>
            </tr>


        </table>

        <div class="center"> <br> <br>
            Accès aux éléments justificatifs
        </div>

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

        <div class="center"> <br> <br>
            Compétences mises en oeuvres
        </div>

        <div id="boxComp">
            <div class="box_grise" id="comp_1">
                <div>Détails : <input style="width:60%; height:50%" type="text"></div>
            </div>
        </div>

        <br>

        <div class="center">
            <button class="center" type="button" onclick="addLien()">
                <img src="https://cdn.pixabay.com/photo/2016/12/21/17/11/signe-1923369_1280.png" alt="" width="50" height="50">
            </button>
        </div>

        <br>

        <div class="center">
            <input type="submit" name="createSituation" value="Envoyer">
        </div>
    </form>
</div>
